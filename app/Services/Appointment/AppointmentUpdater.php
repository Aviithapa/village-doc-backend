<?php

namespace App\Services\Appointment;

use App\Http\Controllers\Api\ApiResponser;
use App\Models\Appointment;
use App\Repositories\Appointment\AppointmentRepository;
use Exception;
use Mockery\Expectation;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

/**
 * Class  AppointmentUpdater
 * @package App\Services\Appointment
 */
class AppointmentUpdater
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;
    use ApiResponser;

    /**
     * AppointmentGetter constructor.
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Store an appointment
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $appointment = $this->appointmentRepository->findOrFail($id);
        try {
            if ($appointment->status === Appointment::STATUS_QUERIED || $appointment->status === Appointment::STATUS_SCHEDULED) {
                $data['updated_by'] = getAuthUser();
                if ($data['status'] === Appointment::STATUS_RESCHEDULED) {
                    $dataArray = [
                        'status' => $data['status'],
                        'reason' => $data['reason']
                    ];
                    $this->appointmentRepository->update($appointment->id, $dataArray);

                    $data['status'] = Appointment::STATUS_SCHEDULED;
                    $appointment = $this->appointmentRepository->store($data);
                    return $appointment;
                } else {
                    $appointmentUpdate = $this->appointmentRepository->update($appointment->id, $data);
                    $appointment =  $this->appointmentRepository->find($id);
                    return $appointment;
                }
            }
            throw  new  BadRequestHttpException('Appointment Cannot be edited');
        } catch (Exception $e) {
            throw $e;
        }
    }





    public function updateBulkAppointment(array $data)
    {
        try {
            $dataArray = [
                'status' => Appointment::STATUS_SCHEDULED,
                'doctor_id' => $data['doctor_id'],
                'appointment_time' => $data['appointment_time'],
            ];

            foreach ($data['appointment_ids'] as $appointmentId) {
                $this->appointmentRepository->update($appointmentId, $dataArray);
            }

            // If the loop completes without throwing an exception, return a success message.
            return 'Appointments updated successfully';
        } catch (Exception $e) {
            // If an exception is caught, rethrow it or handle it accordingly.
            throw $e;
        }
    }


    /** Delete an appointment
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete appointment
        return false;
    }
}
