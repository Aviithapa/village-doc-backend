<?php

namespace App\Services\MenstrualHistory;

use Illuminate\Http\Request;
use App\Repositories\MenstrualHistory\MenstrualHistoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MenstrualHistoryGetter
 * @package App\Services\MenstrualHistory
 */
class MenstrualHistoryGetter
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
     * Get paginated MenstrualHistory list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->MenstrualHistoryRepository->getPaginatedList($request);
    }

    /**
     * Get a single MenstrualHistory
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->MenstrualHistoryRepository->findOrFail($id);
    }
}
