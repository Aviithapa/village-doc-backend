<?php

namespace App\Services\MedicalRecord;

use App\Repositories\MedicalRecord\MedicalRecordComplaintRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  MedicalRecordUpdater
 * @package App\Services\MedicalRecord
 */
class MedicalRecordComplaintUpdater
{
    protected $medicalRecordComplaintRepository;
    /**
     * @var MedicalRecordComplaintRepository
    */

    /**
     * MedicalRecordUpdater constructor.
     * @param MedicalRecordComplaintRepository $medicalRecordComplaintRepository

     */
    public function __construct(MedicalRecordComplaintRepository $medicalRecordComplaintRepository)
    {
        $this->medicalRecordComplaintRepository = $medicalRecordComplaintRepository;
    }

    /**
     * Update an MedicalRecord
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $MedicalRecord = $this->medicalRecordComplaintRepository->find($id);
        try{
            DB::beginTransaction();
            $MedicalRecord =  $this->medicalRecordComplaintRepository->update($id,$data);
            DB::commit();
            $MedicalRecord = $this->medicalRecordComplaintRepository->find($id);
            return $MedicalRecord->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $MedicalRecord = $this->medicalRecordComplaintRepository->delete($id);
        return true;
    }
}
