<?php

namespace App\Services\BMI;

use App\Repositories\BMI\BmiRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  BmiCreator
 * @package App\Services\BMI
 */
class BmiCreator
{
    protected $bmiRepository;
    /**
     * @var BmiRepository
    */

    /**
     * BmiCreator constructor.
     * @param BmiRepository $bmiRepository

     */
    public function __construct(BmiRepository $bmiRepository)
    {
        $this->bmiRepository = $bmiRepository;
    }

    /**
     * Store an bmi
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $heightInMeter = $data['height']/100;
            $data['bmi'] = $data['weight']/($heightInMeter * $heightInMeter);

            $bmi =  $this->bmiRepository->store($data);
            DB::commit();
            return $bmi->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
