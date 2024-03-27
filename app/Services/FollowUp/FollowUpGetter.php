<?php

namespace App\Services\FollowUp;

use App\Repositories\FollowUp\FollowUpRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FollowUpGetter
{
    protected $followupRepository;

    /**
     * @var FollowUpRepository
     */

    /**
     * FollowUpGetter constructor.
     * @param FollowUpRepository $followupRepository
     */
    public function __construct(FollowUpRepository $followupRepository)
    {
        $this->followupRepository = $followupRepository;
    }

    /**
     * Get paginated FollowUp list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->followupRepository->getPaginatedList($request);
    }

    /**
     * Get a single FollowUp
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->followupRepository->findOrFail($id);
    }
}
