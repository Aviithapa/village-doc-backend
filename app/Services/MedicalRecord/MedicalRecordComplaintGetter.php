<?php

namespace App\Services\MedicalRecord;

use App\Repositories\MedicalRecord\MedicalRecordComplaintRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MedicalRecordGetter
 * @package App\Services\MedicalRecord
 */
class MedicalRecordComplaintGetter
{
    protected $medicalRecordComplaintRepository;

    /**
     * @var MedicalRecordComplaintRepository
    */

    /**
     * MedicalRecordGetter constructor.
     * @param MedicalRecordComplaintRepository $medicalRecordComplaintRepository
     */
    public function __construct(MedicalRecordComplaintRepository $medicalRecordComplaintRepository)
    {
        $this->medicalRecordComplaintRepository = $medicalRecordComplaintRepository;
    }

    /**
     * Get paginated MedicalRecord list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->medicalRecordComplaintRepository->getPaginatedList($request);
    }

    /**
     * Get a single MedicalRecord
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->medicalRecordComplaintRepository->findOrFail($id);
    }

}
