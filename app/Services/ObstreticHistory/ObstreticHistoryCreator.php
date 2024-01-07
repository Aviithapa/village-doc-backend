<?php

namespace App\Services\ObstreticHistory;


use App\Repositories\ObstreticHistory\ObstreticHistoryRepository;


/**
 * Class  ObstreticHistoryCreator
 * @package App\Services\ObstreticHistory
 */
class ObstreticHistoryCreator
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
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $ObstreticHistory =  $this->ObstreticHistoryRepository->store($data);
        return $ObstreticHistory;
    }
}
