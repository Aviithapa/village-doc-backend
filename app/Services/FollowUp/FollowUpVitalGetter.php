<?php

namespace App\Services\FollowUp;

use App\Repositories\FollowUp\FollowUpVitalRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FollowUpVitalGetter
{
    protected $followupVitalRepository;

    /**
     * @var FollowUpVitalRepository
     */

    /**
     * FollowUpVitalGetter constructor.
     * @param FollowUpVitalRepository $followupVitalRepository
     */
    public function __construct(FollowUpVitalRepository $followupVitalRepository)
    {
        $this->followupVitalRepository = $followupVitalRepository;
    }

    /**
     * Get paginated FollowUp list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->followupVitalRepository->getPaginatedList($request);
    }

    /**
     * Get a single FollowUp
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->followupVitalRepository->findOrFail($id);
    }
}
