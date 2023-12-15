<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  DepartmentCreator
 * @package App\Services\Department
 */
class DepartmentCreator
{
    protected $departmentRepository;
    /**
     * @var DepartmentRepository
    */


    /**
     * DepartmentCreator constructor.
     * @param DepartmentRepository $departmentRepository
    */
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
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
            $doctor =  $this->departmentRepository->store($data);
            DB::commit();
            return $doctor->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
