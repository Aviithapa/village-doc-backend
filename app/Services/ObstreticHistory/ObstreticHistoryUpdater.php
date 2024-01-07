<?php

namespace App\Services\ObstreticHistory;


use App\Repositories\ObstreticHistory\ObstreticHistoryRepository;
use Exception;

/**
 * Class  ObstreticHistoryUpdater
 * @package App\Services\ObstreticHistory
 */
class ObstreticHistoryUpdater
{
    /**
     * @var ObstreticHistoryRepository
     */
    protected $ObstreticHistoryRepository;



    /**
     * ObstreticHistoryGetter constructor.
     * @param ObstreticHistoryRepository $ObstreticHistoryRepository
     */
    public function __construct(ObstreticHistoryRepository $ObstreticHistoryRepository)
    {
        $this->ObstreticHistoryRepository = $ObstreticHistoryRepository;
    }

    /**
     * Store an ObstreticHistory
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $ObstreticHistorys = $this->ObstreticHistoryRepository->findOrFail($id);
        try {
            $data['updated_by'] = getAuthUser();
            $ObstreticHistoryUpdate = $this->ObstreticHistoryRepository->update($ObstreticHistorys->id, $data);
            $ObstreticHistorys =  $this->ObstreticHistoryRepository->find($id);
            return $ObstreticHistorys;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /** Delete an ObstreticHistory
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->ObstreticHistoryRepository->delete($id);
        return true;
    }
}
