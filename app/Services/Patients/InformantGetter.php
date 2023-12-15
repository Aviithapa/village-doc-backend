<?php

namespace App\Services\Patients;

use App\Repositories\Patients\InformantRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class InformantGetter
 * @package App\Services\Informant
 */
class InformantGetter
{
    protected $informantRepository;

    /**
     * @var InformantRepository
    */

    /**
     * InformantGetter constructor.
     * @param InformantRepository $informantRepository
     */
    public function __construct(InformantRepository $informantRepository)
    {
        $this->informantRepository = $informantRepository;
    }

    /**
     * Get paginated Informant list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->informantRepository->getPaginatedList($request);
    }

    /**
     * Get a single Informant
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->informantRepository->findOrFail($id);
    }

}
