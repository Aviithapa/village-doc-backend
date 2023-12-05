<?php

namespace App\Services\MedicalRecord;


use App\Repositories\MedicalRecord\MedicalRecordRepository;
use Exception;

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
        $medicalRecord = $this->medicalRecordRepository->findOrFail($id);
        try{
            $medicalRecordUpdate = $this->medicalRecordRepository->update($medicalRecord->id,$data);
            $medicalRecord =  $this->medicalRecordRepository->find($id);
            return $medicalRecord;

        }catch(Exception $e){
            throw $e;
        }
    }


    /** Delete an MedicalRecord
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->medicalRecordRepository->delete($id);
        return true;
    }
}
