<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  DepartmentUpdater
 * @package App\Services\Department
 */
class DepartmentUpdater
{
    protected $departmentRepository;
    
    /**
     * @var DepartmentRepository
    */

    /**
     * DepartmentUpdater constructor.
     * @param DepartmentRepository $departmentRepository

     */
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Update an department
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $department = $this->departmentRepository->find($id);
        try{
            DB::beginTransaction();
            $department =  $this->departmentRepository->update($id,$data);
            DB::commit();
            $department = $this->departmentRepository->find($id);
            return $department->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $department = $this->departmentRepository->delete($id);
        return true;
    }
}
