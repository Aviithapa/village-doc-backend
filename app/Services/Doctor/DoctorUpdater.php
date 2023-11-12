<?php

namespace App\Services\Doctor;


use App\Repositories\Doctor\DoctorRepository;

/**
 * Class  DoctorUpdater
 * @package App\Services\Doctor
 */
class DoctorUpdater
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
    public function update(int $id, array $data)
    {
        $doctor = $this->doctorRepository->findOrFail($id);
        $this->doctorRepository->store($data);
        return true;
    }


    /** Delete an doctor
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete doctor
        return false;
    }
}
