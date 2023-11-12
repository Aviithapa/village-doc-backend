<?php

namespace App\Services\Doctor;

use Illuminate\Http\Request;
use App\Repositories\Doctor\DoctorRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class DoctorGetter
 * @package App\Services\Doctor
 */
class DoctorGetter
{
    /**
     * @var DoctorRepository
     */
    protected $doctorRepository;

    /**
     * DoctorGetter constructor.
     * @param DoctorRepository $doctorRepository
     */
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Get paginated doctor list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->doctorRepository->getPaginatedList($request);
    }

    /**
     * Get a single doctor
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->doctorRepository->findOrFail($id);
    }
}
