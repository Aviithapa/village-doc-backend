<?php

namespace App\Services\Alcohol;

use App\Repositories\Alcohol\AlcoholRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  AlcoholUpdator
 * @package App\Services\Alcohol
 */
class AlcoholUpdator
{
    protected $alcoholRepository;
    /**
     * @var AlcoholRepository
    */

    /**
     * AlcoholUpdator constructor.
     * @param AlcoholRepository $alcoholRepository
    */
    public function __construct(AlcoholRepository $alcoholRepository)
    {
        $this->alcoholRepository = $alcoholRepository;
    }

    /**
     * Update an alcohol
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $alcohol = $this->alcoholRepository->find($id);
        try{
            DB::beginTransaction();
            
            $alcoholPercentagePerDay = $data['percentage_of_alcohol'] / 1000;
            $data['percentage_per_day'] = $alcoholPercentagePerDay;
            $unitsConsumedPerDay = $alcoholPercentagePerDay * $data['volume_consumed'];
            $data['volume_consumed_per_week'] = $unitsConsumedPerDay * $data['days_count'];

            $alcohol =  $this->alcoholRepository->update($id,$data);
            DB::commit();
            $alcohol = $this->alcoholRepository->find($id);
            return $alcohol->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $alcohol = $this->alcoholRepository->delete($id);
        return true;
    }
}
