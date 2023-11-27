<?php

namespace App\Services\Doctor;


use App\Repositories\Doctor\DoctorScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


/**
 * Class  DoctorScheduleGetter
 * @package App\Services\Doctor
 */
class DoctorScheduleGetter
{
    /**
     * @var DoctorScheduleRepository
     */
    protected $doctorScheduleRepository;
    

    /**
     * DoctorSchedulrGetter constructor.
     * @param DoctorScheduleRepository $doctorScheduleRepository

     */
    public function __construct(DoctorScheduleRepository $doctorScheduleRepository)
    {
        $this->doctorScheduleRepository = $doctorScheduleRepository;
    }

    /**
     * Get paginated doctor list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->doctorScheduleRepository->getPaginatedList($request);
    }

    /**
     * Get a single doctor schedule
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->doctorScheduleRepository->findOrFail($id);
    }
}
