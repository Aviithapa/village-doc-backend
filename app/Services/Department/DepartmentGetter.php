<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class DepartmentGetter
 * @package App\Services\Department
 */
class DepartmentGetter
{
    protected $departmentRepository;

    /**
     * @var DepartmentRepository
    */

    /**
     * DepartmentGetter constructor.
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Get paginated department list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->departmentRepository->getPaginatedList($request);
    }

    /**
     * Get a single department
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->departmentRepository->findOrFail($id);
    }

}
