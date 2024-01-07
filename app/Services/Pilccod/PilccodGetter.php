<?php

namespace App\Services\Pilccod;

use Illuminate\Http\Request;
use App\Repositories\Pilccod\PilccodRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PilccodGetter
 * @package App\Services\Pilccod
 */
class PilccodGetter
{
    /**
     * @var PilccodRepository
     */
    protected $PilccodRepository;



    /**
     * PilccodGetter constructor.
     * @param PilccodRepository $PilccodRepository
     */
    public function __construct(PilccodRepository $PilccodRepository)
    {
        $this->PilccodRepository = $PilccodRepository;
    }

    /**
     * Get paginated Pilccod list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->PilccodRepository->getPaginatedList($request);
    }

    /**
     * Get a single Pilccod
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->PilccodRepository->findOrFail($id);
    }
}
