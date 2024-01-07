<?php

namespace App\Services\PatientHistory;


use App\Repositories\PatientHistory\PatientHistoryRepository;
use Exception;

/**
 * Class  PatientHistoryUpdater
 * @package App\Services\PatientHistory
 */
class PatientHistoryUpdater
{
    /**
     * @var PatientHistoryRepository
     */
    protected $PatientHistoryRepository;



    /**
     * PatientHistoryGetter constructor.
     * @param PatientHistoryRepository $PatientHistoryRepository
     */
    public function __construct(PatientHistoryRepository $PatientHistoryRepository)
    {
        $this->PatientHistoryRepository = $PatientHistoryRepository;
    }

    /**
     * Store an PatientHistory
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $PatientHistorys = $this->PatientHistoryRepository->findOrFail($id);
        try {
            $data['updated_by'] = getAuthUser();
            $PatientHistoryUpdate = $this->PatientHistoryRepository->update($PatientHistorys->id, $data);
            $PatientHistorys =  $this->PatientHistoryRepository->find($id);
            return $PatientHistorys;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /** Delete an PatientHistory
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->PatientHistoryRepository->delete($id);
        return true;
    }
}
