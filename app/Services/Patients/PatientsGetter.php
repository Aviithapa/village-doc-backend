<?php

namespace App\Services\Patients;

use Illuminate\Http\Request;
use App\Repositories\Patients\PatientsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PatientsGetter
 * @package App\Services\Patients
 */
class PatientsGetter
{
    /**
     * @var PatientsRepository
     */
    protected $patientsRepository;

    /**
     * PatientsGetter constructor.
     * @param PatientsRepository $patientsRepository
     */
    public function __construct(PatientsRepository $patientsRepository)
    {
        $this->patientsRepository = $patientsRepository;
    }

    /**
     * Get paginated Patients list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->patientsRepository->getPaginatedList($request);
    }

    /**
     * Get a single Patients
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->patientsRepository->findOrFail($id);
    }
}
