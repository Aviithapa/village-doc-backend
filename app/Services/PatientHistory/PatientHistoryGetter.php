<?php

namespace App\Services\PatientHistory;

use Illuminate\Http\Request;
use App\Repositories\PatientHistory\PatientHistoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PatientHistoryGetter
 * @package App\Services\PatientHistory
 */
class PatientHistoryGetter
{
    /**
     * @var PatientHistoryRepository
     */
    protected $PatientHistoryRepository;



    /**
     * PatientHistoryGetter constructor.
     * @param PatientHistoryRepository $PatientHistoryRepository
     */
    public function __construct(PatientHistoryRepository $PatientHistoryRepository)
    {
        $this->PatientHistoryRepository = $PatientHistoryRepository;
    }

    /**
     * Get paginated PatientHistory list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->PatientHistoryRepository->getPaginatedList($request);
    }

    /**
     * Get a single PatientHistory
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->PatientHistoryRepository->findOrFail($id);
    }
}
