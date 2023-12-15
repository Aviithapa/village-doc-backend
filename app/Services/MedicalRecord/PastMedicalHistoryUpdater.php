<?php

namespace App\Services\MedicalRecord;

use App\Repositories\MedicalRecord\PastMedicalHistoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  PastMedicalHistoryUpdater
 * @package App\Services\PastMedicalHistory
 */
class PastMedicalHistoryUpdater
{
    protected $pastMedicalHistoryRepository;
    /**
     * @var PastMedicalHistoryRepository
    */

    /**
     * PastMedicalHistoryUpdater constructor.
     * @param PastMedicalHistoryRepository $pastMedicalHistoryRepository
    */
    public function __construct(PastMedicalHistoryRepository $pastMedicalHistoryRepository)
    {
        $this->pastMedicalHistoryRepository = $pastMedicalHistoryRepository;
    }

    /**
     * Update an PastMedicalHistory
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $pastMedicalHistory = $this->pastMedicalHistoryRepository->find($id);
        try{
            DB::beginTransaction();
                $pastMedicalHistory =  $this->pastMedicalHistoryRepository->update($id,$data);
            DB::commit();
            
            $pastMedicalHistory = $this->pastMedicalHistoryRepository->find($id);
            return $pastMedicalHistory->refresh();
        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $pastMedicalHistory = $this->pastMedicalHistoryRepository->delete($id);
        return true;
    }
}
