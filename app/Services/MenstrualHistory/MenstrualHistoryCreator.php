<?php

namespace App\Services\MenstrualHistory;


use App\Repositories\MenstrualHistory\MenstrualHistoryRepository;


/**
 * Class  MenstrualHistoryCreator
 * @package App\Services\MenstrualHistory
 */
class MenstrualHistoryCreator
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
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $MenstrualHistory =  $this->MenstrualHistoryRepository->store($data);
        return $MenstrualHistory;
    }
}
