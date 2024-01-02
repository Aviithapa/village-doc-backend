<?php

namespace App\Services\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Repositories\Doctor\DoctorRepository;
use App\Services\Appointment\AppointmentGetter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class DoctorGetter
 * @package App\Services\Doctor
 */
class DoctorGetter
{
    protected $doctorRepository;
    protected $appointmentGetter;

    /**
     * @var DoctorRepository
     */

    /**
     * DoctorGetter constructor.
     * @param DoctorRepository $doctorRepository
     */
    public function __construct(DoctorRepository $doctorRepository, AppointmentGetter $appointmentGetter)
    {
        $this->doctorRepository = $doctorRepository;
        $this->appointmentGetter = $appointmentGetter;
    }

    /**
     * Get paginated doctor list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->doctorRepository->getPaginatedList($request);
    }

    /**
     * Get a single doctor
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->doctorRepository->findOrFail($id);
    }

    public function doctorList($data)
    {
        if (isset($data['appointment_date'])) {
            $doctors = Doctor::get()->pluck('id');
            $doc = [];
            foreach ($doctors as $doctor) {
                $response = $this->appointmentGetter->checkAppointment($data['appointment_date'], $doctor);
                if ($response) {
                    $doc[] = $doctor;
                }
            }
            $doctors = Doctor::select(DB::raw('id, CONCAT(salutation, " ", first_name," ", last_name) as name'))
                ->whereIn('id', $doc)
                ->get()->toArray();
        } else {
            $doctors = Doctor::select(DB::raw('id, CONCAT(salutation, " ", first_name," ", last_name) as name'))->get()->toArray();
        }

        return $doctors;
    }

    public function all()
    {
        return $this->doctorRepository->all();
    }
}
