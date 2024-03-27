<?php

namespace App\Repositories\FollowUpVital;

use App\Models\FollowUpVital;
use App\Repositories\FollowUp\FollowUpVitalFilter;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FollowUpVitalRepository extends Repository
{

    /**
     * FollowUpVitalRepository constructor.
     * @param FollowUpVital $FollowUpVital
     */
    public function __construct(FollowUpVital $followUpVital)
    {
        parent::__construct($followUpVital);
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
            ->filter(new FollowUpVitalFilter($request))
            ->latest()
            ->paginate($limit);
    }
}
