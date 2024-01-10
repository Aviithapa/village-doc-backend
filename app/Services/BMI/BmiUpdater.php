<?php

namespace App\Services\BMI;

use App\Repositories\BMI\BmiRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  BmiUpdater
 * @package App\Services\Bmi
 */
class BmiUpdater
{
    protected $bmiRepository;
    /**
     * @var BmiRepository
    */

    /**
     * BmiUpdater constructor.
     * @param BmiRepository $bmiRepository
    */
    public function __construct(BmiRepository $bmiRepository)
    {
        $this->bmiRepository = $bmiRepository;
    }

    /**
     * Update an bmi
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $bmi = $this->bmiRepository->find($id);
        try{
            DB::beginTransaction();
            $heightInMeter = $data['height']/100;
            $data['bmi'] = $data['weight']/($heightInMeter * $heightInMeter);
            $bmi =  $this->bmiRepository->update($id,$data);
            DB::commit();
            $bmi = $this->bmiRepository->find($id);
            return $bmi->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $bmi = $this->bmiRepository->delete($id);
        return true;
    }
}
