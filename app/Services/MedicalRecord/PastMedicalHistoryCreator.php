<?php

namespace App\Services\MedicalRecord;

use App\Repositories\MedicalRecord\PastMedicalHistoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  PastMedicalHistoryCreator
 * @package App\Services\PastMedicalHistory
 */
class PastMedicalHistoryCreator
{
    /**
     * @var PastMedicalHistoryRepository
     */
    protected $pastMedicalHistoryRepository;

    /**
     * PastMedicalHistoryCreator constructor.
     * @param PastMedicalHistoryRepository $pastMedicalHistoryRepository

     */
    public function __construct(PastMedicalHistoryRepository $pastMedicalHistoryRepository)
    {
        $this->pastMedicalHistoryRepository = $pastMedicalHistoryRepository;
    }

    /**
     * Store an PastMedicalHistory
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();
            $pastMedicalHistory =  $this->pastMedicalHistoryRepository->store($data);
            DB::commit();
            return $pastMedicalHistory->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
