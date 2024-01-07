<?php

namespace App\Services\ObstreticHistory;

use Illuminate\Http\Request;
use App\Repositories\ObstreticHistory\ObstreticHistoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ObstreticHistoryGetter
 * @package App\Services\ObstreticHistory
 */
class ObstreticHistoryGetter
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
     * Get paginated ObstreticHistory list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->ObstreticHistoryRepository->getPaginatedList($request);
    }

    /**
     * Get a single ObstreticHistory
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->ObstreticHistoryRepository->findOrFail($id);
    }
}
