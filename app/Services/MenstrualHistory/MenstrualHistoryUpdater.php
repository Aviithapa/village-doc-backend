<?php

namespace App\Services\MenstrualHistory;


use App\Repositories\MenstrualHistory\MenstrualHistoryRepository;
use Exception;

/**
 * Class  MenstrualHistoryUpdater
 * @package App\Services\MenstrualHistory
 */
class MenstrualHistoryUpdater
{
    /**
     * @var MenstrualHistoryRepository
     */
    protected $MenstrualHistoryRepository;



    /**
     * MenstrualHistoryGetter constructor.
     * @param MenstrualHistoryRepository $MenstrualHistoryRepository
     */
    public function __construct(MenstrualHistoryRepository $MenstrualHistoryRepository)
    {
        $this->MenstrualHistoryRepository = $MenstrualHistoryRepository;
    }

    /**
     * Store an MenstrualHistory
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $MenstrualHistorys = $this->MenstrualHistoryRepository->findOrFail($id);
        try {
            $data['updated_by'] = getAuthUser();
            $MenstrualHistoryUpdate = $this->MenstrualHistoryRepository->update($MenstrualHistorys->id, $data);
            $MenstrualHistorys =  $this->MenstrualHistoryRepository->find($id);
            return $MenstrualHistorys;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /** Delete an MenstrualHistory
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->MenstrualHistoryRepository->delete($id);
        return true;
    }
}
