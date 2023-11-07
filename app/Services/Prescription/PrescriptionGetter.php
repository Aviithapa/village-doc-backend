<?php

namespace App\Services\Prescription;

use Illuminate\Http\Request;
use App\Repositories\Prescription\PrescriptionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PrescriptionGetter
 * @package App\Services\Prescription
 */
class PrescriptionGetter
{
    /**
     * @var PrescriptionRepository
     */
    protected $prescriptionRepository;



    /**
     * PrescriptionGetter constructor.
     * @param PrescriptionRepository $prescriptionRepository
     */
    public function __construct(PrescriptionRepository $prescriptionRepository)
    {
        $this->prescriptionRepository = $prescriptionRepository;
    }

    /**
     * Get paginated prescription list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->prescriptionRepository->getPaginatedList($request);
    }

    /**
     * Get a single prescription
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->prescriptionRepository->findOrFail($id);
    }
}
