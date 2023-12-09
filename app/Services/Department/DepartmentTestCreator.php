<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentTestRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  DepartmentCreator
 * @package App\Services\Department
 */

class DepartmentTestCreator
{
    protected $departmentTestRepository;
    /**
     * @var DepartmentTestRepository
    */

    /**
     * DepartmentTestCreator constructor.
     * @param DepartmentTestRepository $departmentTestRepository
    */
    public function __construct(DepartmentTestRepository $departmentTestRepository)
    {
        $this->departmentTestRepository = $departmentTestRepository;
    }

    /**
     * Store an department
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();
            $doctor =  $this->departmentTestRepository->store($data);
            DB::commit();
            return $doctor->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
