<?php

namespace App\Services\MedicalRecord;

use App\Repositories\MedicalRecord\MedicalRecordComplaintRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  MedicalRecordComplaintCreator
 * @package App\Services\MedicalRecord
 */
class MedicalRecordComplaintCreator
{
    /**
     * @var MedicalRecordComplaintRepository
     */
    protected $medicalRecordComplaintRepository;


    /**
     * MedicalRecordComplaintCreator constructor.
     * @param MedicalRecordComplaintRepository $medicalRecordComplaintRepository

     */
    public function __construct(MedicalRecordComplaintRepository $medicalRecordComplaintRepository)
    {
        $this->medicalRecordComplaintRepository = $medicalRecordComplaintRepository;
    }

    /**
     * Store an medical record complaint
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();
            $doctor =  $this->medicalRecordComplaintRepository->store($data);
            DB::commit();
            return $doctor->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
