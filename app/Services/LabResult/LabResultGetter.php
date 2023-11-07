<?php

namespace App\Services\LabResult;

use Illuminate\Http\Request;
use App\Repositories\LabResult\LabResultRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LabResultGetter
 * @package App\Services\LabResult
 */
class LabResultGetter
{
    /**
     * @var LabResultRepository
     */
    protected $labResultRepository;



    /**
     * LabResultGetter constructor.
     * @param LabResultRepository $labResultRepository
     */
    public function __construct(LabResultRepository $labResultRepository)
    {
        $this->labResultRepository = $labResultRepository;
    }

    /**
     * Get paginated labResult list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->labResultRepository->getPaginatedList($request);
    }

    /**
     * Get a single labResult
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->labResultRepository->findOrFail($id);
    }
}
