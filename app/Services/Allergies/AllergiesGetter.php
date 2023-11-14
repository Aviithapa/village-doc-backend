<?php

namespace App\Services\Allergies;

use Illuminate\Http\Request;
use App\Repositories\Allergies\AllergiesRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AllergiesGetter
 * @package App\Services\Allergies
 */
class AllergiesGetter
{
    /**
     * @var AllergiesRepository
     */
    protected $allergiesRepository;



    /**
     * AllergiesGetter constructor.
     * @param AllergiesRepository $allergiesRepository
     */
    public function __construct(AllergiesRepository $allergiesRepository)
    {
        $this->allergiesRepository = $allergiesRepository;
    }

    /**
     * Get paginated allergies list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->allergiesRepository->getPaginatedList($request);
    }

    /**
     * Get a single allergies
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        $data = $this->allergiesRepository->all()->where('patient_id', $id)->toArray();
        return array_values($data);
    }

    /**
     * Get a single allergies
     * @param $id
     * @return Object|null
     */
    public function patientTodayAllergies($id)
    {
        $data = $this->allergiesRepository->all()->where('patient_id', $id)->toArray();
        return array_values($data);
    }
}
