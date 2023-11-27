<?php

namespace App\Services\Doctor;


use App\Repositories\Doctor\DoctorScheduleRepository;


/**
 * Class  DoctorScheduleCreator
 * @package App\Services\Doctor
 */
class DoctorScheduleCreator
{
    /**
     * @var DoctorScheduleRepository
     */
    protected $doctorScheduleRepository;


    /**
     * DoctorGetter constructor.
     * @param DoctorScheduleRepository $doctorScheduleRepository

     */
    public function __construct(DoctorScheduleRepository $doctorScheduleRepository)
    {
        $this->doctorScheduleRepository = $doctorScheduleRepository;
    }

    /**
     * Store an doctor
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $doctor =  $this->doctorScheduleRepository->store($data);
        return $doctor->refresh();
    }
}
