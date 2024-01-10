<?php

namespace App\Services\BMI;

use App\Repositories\BMI\BmiRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class BmiGetter
 * @package App\Services\BMI
 */
class BmiGetter
{
    protected $bmiRepository;

    /**
     * @var BmiRepository
    */

    /**
     * BmiGetter constructor.
     * @param BmiRepository $bmiRepository
     */
    public function __construct(BmiRepository $bmiRepository)
    {
        $this->bmiRepository = $bmiRepository;
    }

    /**
     * Get paginated Bmi list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->bmiRepository->getPaginatedList($request);
    }

    /**
     * Get a single Bmi
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->bmiRepository->findOrFail($id);
    }

}
