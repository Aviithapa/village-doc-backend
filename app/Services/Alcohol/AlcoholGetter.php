<?php

namespace App\Services\Alcohol;

use App\Repositories\Alcohol\AlcoholRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AlcoholGetter
 * @package App\Services\Alcohol
 */
class AlcoholGetter
{
    protected $alcoholRepository;

    /**
     * @var AlcoholRepository
    */

    /**
     * AlcoholGetter constructor.
     * @param AlcoholRepository $alcoholRepository
     */
    public function __construct(AlcoholRepository $alcoholRepository)
    {
        $this->alcoholRepository = $alcoholRepository;
    }

    /**
     * Get paginated Bmi list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->alcoholRepository->getPaginatedList($request);
    }

    /**
     * Get a single Bmi
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->alcoholRepository->findOrFail($id);
    }

}
