<?php

namespace App\Services\PackYear;

use App\Repositories\PackYear\PackYearRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PackYearGetter
 * @package App\Services\PackYear
 */
class PackYearGetter
{
    protected $packYearRepository;

    /**
     * @var PackYearRepository
    */

    /**
     * PackYearGetter constructor.
     * @param PackYearRepository $packYearRepository
     */
    public function __construct(PackYearRepository $packYearRepository)
    {
        $this->packYearRepository = $packYearRepository;
    }

    /**
     * Get paginated Bmi list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->packYearRepository->getPaginatedList($request);
    }

    /**
     * Get a single Bmi
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->packYearRepository->findOrFail($id);
    }

}
