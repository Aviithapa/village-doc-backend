<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentTestRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class DepartmentTestGetter
 * @package App\Services\DepartmentTest
 */
class DepartmentTestGetter
{
    protected $departmentTestRepository;

    /**
     * @var DepartmentTestRepository
    */

    /**
     * DepartmentTestGetter constructor.
     * @param DepartmentTestRepository $departmentTestRepository
     */
    public function __construct(DepartmentTestRepository $departmentTestRepository)
    {
        $this->departmentTestRepository = $departmentTestRepository;
    }

    /**
     * Get paginated department list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->departmentTestRepository->getPaginatedList($request);
    }

    /**
     * Get a single departmentTest
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->departmentTestRepository->findOrFail($id);
    }

}
