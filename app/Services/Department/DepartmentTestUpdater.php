<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentTestRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  DepartmentUpdater
 * @package App\Services\Department
 */
class DepartmentTestUpdater
{
    /**
     * @var DepartmentTestRepository
     */
    protected $departmentTestRepository;


    /**
     * DepartmentTestUpdater constructor.
     * @param DepartmentTestRepository $departmentTestRepository

     */
    public function __construct(DepartmentTestRepository $departmentTestRepository)
    {
        $this->departmentTestRepository = $departmentTestRepository;
    }

    /**
     * Update an departmentTest
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $department = $this->departmentTestRepository->find($id);
        try{
            DB::beginTransaction();
            $department =  $this->departmentTestRepository->update($id,$data);
            DB::commit();
            $department = $this->departmentTestRepository->find($id);
            return $department->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $department = $this->departmentTestRepository->delete($id);
        return true;
    }
}
