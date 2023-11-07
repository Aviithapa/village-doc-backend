<?php

namespace App\Services\MedicalRecord;


use App\Repositories\MedicalRecord\MedicalRecordRepository;

/**
 * Class  MedicalRecordUpdater
 * @package App\Services\MedicalRecord
 */
class MedicalRecordUpdater
{
    /**
     * @var MedicalRecordRepository
     */
    protected $medicalRecordRepository;



    /**
     * MedicalRecordGetter constructor.
     * @param MedicalRecordRepository $medicalRecordRepository
     */
    public function __construct(MedicalRecordRepository $medicalRecordRepository)
    {
        $this->medicalRecordRepository = $medicalRecordRepository;
    }

    /**
     * Store an MedicalRecord
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $MedicalRecord = $this->medicalRecordRepository->findOrFail($id);
        $this->medicalRecordRepository->store($data);
        return true;
    }


    /** Delete an MedicalRecord
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete MedicalRecord
        return false;
    }
}
