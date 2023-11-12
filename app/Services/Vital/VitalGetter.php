<?php

namespace App\Services\Vital;

use Illuminate\Http\Request;
use App\Repositories\Vital\VitalRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class VitalGetter
 * @package App\Services\Vital
 */
class VitalGetter
{
    /**
     * @var VitalRepository
     */
    protected $vitalRepository;



    /**
     * VitalGetter constructor.
     * @param VitalRepository $vitalRepository
     */
    public function __construct(VitalRepository $vitalRepository)
    {
        $this->vitalRepository = $vitalRepository;
    }

    /**
     * Get paginated Vital list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->vitalRepository->getPaginatedList($request);
    }

    /**
     * Get a single vital
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->vitalRepository->findOrFail($id);
    }

    /**
     * Get a single vital
     * @param $id
     * @return Object|null
     */
    public function patientTodayVital($id)
    {
        $today = Carbon::now('Asia/Kathmandu')->format('Y-m-d');
        $data = $this->vitalRepository->all()->where('patient_id', $id)->where('date_of_measurement', $today)->toArray();
        return array_values($data);
    }
}
