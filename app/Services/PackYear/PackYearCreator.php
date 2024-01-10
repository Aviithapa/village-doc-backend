<?php

namespace App\Services\PackYear;

use App\Repositories\PackYear\PackYearRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  PackYearCreator
 * @package App\Services\PackYear
 */
class PackYearCreator
{
    protected $packYearRepository;
    /**
     * @var packYearRepository
    */

    /**
     * PackYearCreator constructor.
     * @param PackYearRepository $packYearRepository

     */
    public function __construct(PackYearRepository $packYearRepository)
    {
        $this->packYearRepository = $packYearRepository;
    }

    /**
     * Store an packYear
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $packPerDay = $data['no_of_cigarettes'] / 20;
            $data['pack_per_day'] = $packPerDay * $data['duration'];

            $packYear =  $this->packYearRepository->store($data);
            DB::commit();
            return $packYear->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
