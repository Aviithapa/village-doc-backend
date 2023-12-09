<?php

namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentRepository extends Repository
{

    /**
     * DepartmentRepository constructor.
     * @param Department $Department
     */
    public function __construct(Department $department)
    {
        parent::__construct($department);
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
