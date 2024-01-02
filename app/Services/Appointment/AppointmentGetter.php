<?php

namespace App\Services\Appointment;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Repositories\Appointment\AppointmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AppointmentGetter
 * @package App\Services\Appointment
 */
class AppointmentGetter
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentGetter constructor.
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Get paginated appointment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->appointmentRepository->getPaginatedList($request);
    }

    /**
     * Get a single appointment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->appointmentRepository->findOrFail($id);
    }

    public function checkAppointment($appointmentDate, $doctorId)
    {
        $appointmentDate = $data['appointment_date'] ?? null;

        $appointmentCount = Appointment::where([
            ['doctor_id', $doctorId],
            ['appointment_date', $appointmentDate]
        ])
            ->get()
            ->count();

        if ($appointmentCount <= 30)
            return true;

        return false;
    }


    public function getAppointmentUniqueUser()
    {
        $appointments = $this->appointmentRepository->all()->where('status', Appointment::STATUS_QUERIED);
        $uniqueUsers = [];

        foreach ($appointments as $appointment) {
            $medicalRecord = $appointment->medicalRecord;

            // Make sure the medical record and user relationships are loaded
            $medicalRecord->load('user');

            $creatorId = $medicalRecord->user->id;
            $creatorName = $medicalRecord->user->username;

            // Check if the user ID and name combination is not already in the array to keep it unique
            if (!isset($uniqueUsers[$creatorId][$creatorName])) {
                $uniqueUsers[$creatorId][$creatorName] = [
                    'id' => $creatorId,
                    'name' => $creatorName,
                ];
            }
        }

        // Flatten the uniqueUsers array to get a simple array of unique users
        $flattenedUniqueUsers = [];

        foreach ($uniqueUsers as $userGroup) {
            foreach ($userGroup as $uniqueUser) {
                $flattenedUniqueUsers[] = $uniqueUser;
            }
        }

        return $flattenedUniqueUsers;
    }
}
