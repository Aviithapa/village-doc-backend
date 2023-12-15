<?php

namespace App\Services\MedicalRecord;

use App\Repositories\MedicalRecord\PastMedicalHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PastMedicalHistoryGetter
 * @package App\Services\PastMedicalHistory
 */
class PastMedicalHistoryGetter
{
    protected $pastMedicalHistoryRepository;

    /**
     * @var PastMedicalHistoryRepository
    */

    /**
     * PastMedicalHistoryGetter constructor.
     * @param PastMedicalHistoryRepository $pastMedicalHistoryRepository
    */
    public function __construct(PastMedicalHistoryRepository $pastMedicalHistoryRepository)
    {
        $this->pastMedicalHistoryRepository = $pastMedicalHistoryRepository;
    }

    /**
     * Get paginated PastMedicalHistory list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->pastMedicalHistoryRepository->getPaginatedList($request);
    }

    /**
     * Get a single PastMedicalHistory
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->pastMedicalHistoryRepository->findOrFail($id);
    }

}
