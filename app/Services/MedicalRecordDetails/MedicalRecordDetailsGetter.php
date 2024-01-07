<?php

namespace App\Services\MedicalRecordDetails;

use Illuminate\Http\Request;
use App\Repositories\MedicalRecordDetails\MedicalRecordDetailsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MedicalRecordDetailsGetter
 * @package App\Services\MedicalRecordDetails
 */
class MedicalRecordDetailsGetter
{
    /**
     * @var MedicalRecordDetailsRepository
     */
    protected $MedicalRecordDetailsRepository;



    /**
     * MedicalRecordDetailsGetter constructor.
     * @param MedicalRecordDetailsRepository $MedicalRecordDetailsRepository
     */
    public function __construct(MedicalRecordDetailsRepository $MedicalRecordDetailsRepository)
    {
        $this->MedicalRecordDetailsRepository = $MedicalRecordDetailsRepository;
    }

    /**
     * Get paginated MedicalRecordDetails list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->MedicalRecordDetailsRepository->getPaginatedList($request);
    }

    /**
     * Get a single MedicalRecordDetails
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->MedicalRecordDetailsRepository->findOrFail($id);
    }
}
