<?php

namespace App\Services\doctor;


use App\Repositories\Doctor\DoctorRepository;


/**
 * Class  DoctorCreator
 * @package App\Services\Doctor
 */
class DoctorCreator
{
    /**
     * @var DoctorRepository
     */
    protected $doctorRepository;


    /**
     * DoctorGetter constructor.
     * @param DoctorRepository $doctorRepository

     */
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Store an doctor
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $doctor =  $this->doctorRepository->store($data);
        return $doctor->refresh();
    }
}
