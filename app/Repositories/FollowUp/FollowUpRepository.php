<?php

namespace App\Repositories\FollowUp;

use App\Models\FollowUp;
use App\Repositories\FollowUp\FollowUpFilter;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FollowUpRepository extends Repository
{

    /**
     * FollowUpRepository constructor.
     * @param FollowUp $FollowUp
     */
    public function __construct(FollowUp $followUp)
    {
        parent::__construct($followUp);
    }

    /**
     * @param Request $request
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));

        return $this->model->newQuery()
            ->filter(new FollowUpFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
