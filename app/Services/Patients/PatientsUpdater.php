<?php

namespace App\Services\Patients;


use App\Repositories\Patients\PatientsRepository;

/**
 * Class  PatientsUpdater
 * @package App\Services\Patients
 */
class PatientsUpdater
{
    /**
     * @var PatientsRepository
     */
    protected $patientsRepository;

    /**
     * PatientsGetter constructor.
     * @param PatientsRepository $patientsRepository
     */
    public function __construct(PatientsRepository $patientsRepository)
    {
        $this->patientsRepository = $patientsRepository;
    }

    /**
     * Store an patients
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $patients = $this->patientsRepository->findOrFail($id);
        $this->patientsRepository->store($data);
        return true;
    }


    /** Delete an patients
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete patients
        return false;
    }
}
