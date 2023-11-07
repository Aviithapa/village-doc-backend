<?php

namespace App\Repositories\LabResult;

use App\Models\LabResult;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class LabResultRepository extends Repository
{

    /**
     * LabResultRepository constructor.
     * @param LabResult $LabResult
     */
    public function __construct(LabResult $LabResult)
    {
        parent::__construct($LabResult);
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
