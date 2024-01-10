<?php

namespace App\Services\Alcohol;

use App\Repositories\Alcohol\AlcoholRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  AlcoholCreator
 * @package App\Services\Alcohol
 */
class AlcoholCreator
{
    protected $alcoholRepository;
    /**
     * @var AlcoholRepository
    */

    /**
     * AlcoholCreator constructor.
     * @param AlcoholRepository $alcoholRepository

     */
    public function __construct(AlcoholRepository $alcoholRepository)
    {
        $this->alcoholRepository = $alcoholRepository;
    }

    /**
     * Store an Alcohol
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $alcoholPercentagePerDay = $data['percentage_of_alcohol'] / 1000;
            $data['percentage_per_day'] = $alcoholPercentagePerDay;
            $unitsConsumedPerDay = $alcoholPercentagePerDay * $data['volume_consumed'];
            $data['volume_consumed_per_week'] = $unitsConsumedPerDay * $data['days_count'];


            $alcohol =  $this->alcoholRepository->store($data);
            DB::commit();
            return $alcohol->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
