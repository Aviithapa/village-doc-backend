<?php

namespace App\Repositories\Complaint;

use App\Models\Complaint;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ComplaintRepository extends Repository
{

    /**
     * ComplaintRepository constructor.
     * @param Complaint $complaint
     */
    public function __construct(Complaint $complaint)
    {
        parent::__construct($complaint);
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
            ->latest()
            ->paginate($limit);
    }
}
