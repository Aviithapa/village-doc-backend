<?php

namespace App\Services\PackYear;

use App\Repositories\PackYear\PackYearRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  PackYearUpdator
 * @package App\Services\PackYear
 */
class PackYearUpdator
{
    protected $packYearRepository;
    /**
     * @var PackYearRepository
    */

    /**
     * PackYearUpdator constructor.
     * @param PackYearRepository $packYearRepository
    */
    public function __construct(PackYearRepository $packYearRepository)
    {
        $this->packYearRepository = $packYearRepository;
    }

    /**
     * Update an packYear
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $packYear = $this->packYearRepository->find($id);
        try{
            DB::beginTransaction();
                $packPerDay = $data['no_of_cigarettes'] / 20;
                $data['pack_per_day'] = $packPerDay * $data['duration'];
                $packYear =  $this->packYearRepository->update($id,$data);
            DB::commit();
            $packYear = $this->packYearRepository->find($id);
            return $packYear->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $packYear = $this->packYearRepository->delete($id);
        return true;
    }
}
