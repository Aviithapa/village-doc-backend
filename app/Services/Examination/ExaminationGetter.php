<?php

namespace App\Services\Examination;

use Illuminate\Http\Request;
use App\Repositories\Examination\ExaminationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ExaminationGetter
 * @package App\Services\Examination
 */
class ExaminationGetter
{
    /**
     * @var ExaminationRepository
     */
    protected $ExaminationRepository;



    /**
     * ExaminationGetter constructor.
     * @param ExaminationRepository $ExaminationRepository
     */
    public function __construct(ExaminationRepository $ExaminationRepository)
    {
        $this->ExaminationRepository = $ExaminationRepository;
    }

    /**
     * Get paginated Examination list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->ExaminationRepository->getPaginatedList($request);
    }

    /**
     * Get a single Examination
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->ExaminationRepository->findOrFail($id);
    }
}
