<?php

namespace App\Services\Patients;

use App\Repositories\Patients\InformantRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  InformantCreator
 * @package App\Services\Informant
 */
class InformantCreator
{
    /**
     * @var InformantRepository
     */
    protected $informantRepository;

    /**
     * InformantCreator constructor.
     * @param InformantRepository $informantRepository

     */
    public function __construct(InformantRepository $informantRepository)
    {
        $this->informantRepository = $informantRepository;
    }

    /**
     * Store an Informant
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();
            $informant =  $this->informantRepository->store($data);
            DB::commit();
            return $informant->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
