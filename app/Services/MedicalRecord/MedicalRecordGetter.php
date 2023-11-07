<?php

namespace App\Services\MedicalRecord;

use Illuminate\Http\Request;
use App\Repositories\MedicalRecord\MedicalRecordRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MedicalRecordGetter
 * @package App\Services\MedicalRecord
 */
class MedicalRecordGetter
{
    /**
     * @var MedicalRecordRepository
     */
    protected $medicalRecordRepository;



    /**
     * MedicalRecordGetter constructor.
     * @param MedicalRecordRepository $medicalRecordRepository
     */
    public function __construct(MedicalRecordRepository $medicalRecordRepository)
    {
        $this->medicalRecordRepository = $medicalRecordRepository;
    }

    /**
     * Get paginated MedicalRecord list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->medicalRecordRepository->getPaginatedList($request);
    }

    /**
     * Get a single MedicalRecord
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->medicalRecordRepository->findOrFail($id);
    }
}
