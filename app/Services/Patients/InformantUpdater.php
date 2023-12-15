<?php

namespace App\Services\Patients;

use App\Repositories\Patients\InformantRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  InformantUpdater
 * @package App\Services\Informant
 */
class InformantUpdater
{
    protected $informantRepository;
    /**
     * @var InformantRepository
    */

    /**
     * InformantUpdater constructor.
     * @param InformantRepository $informantRepository
    */
    public function __construct(InformantRepository $informantRepository)
    {
        $this->informantRepository = $informantRepository;
    }

    /**
     * Update an Informant
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id,array $data)
    {
        $informant = $this->informantRepository->find($id);
        try{
            DB::beginTransaction();
            $informant =  $this->informantRepository->update($id,$data);
            DB::commit();
            $informant = $this->informantRepository->find($id);
            return $informant->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $Informant = $this->informantRepository->delete($id);
        return true;
    }
}
