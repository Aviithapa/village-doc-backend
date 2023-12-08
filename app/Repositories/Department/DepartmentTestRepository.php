<?php

namespace App\Repositories\Department;

use App\Models\DepartmentTest;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentTestRepository extends Repository
{

    /**
     * DepartmentTestRepository constructor.
     * @param DepartmentTest $DepartmentTest
     */
    public function __construct(DepartmentTest $departmentTest)
    {
        parent::__construct($departmentTest);
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
