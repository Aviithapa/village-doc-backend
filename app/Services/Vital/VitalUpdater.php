<?php

namespace App\Services\Vital;


use App\Repositories\Vital\VitalRepository;
use Exception;

/**
 * Class  VitalUpdater
 * @package App\Services\Vital
 */
class VitalUpdater
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
     * Store an vital
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $vitals = $this->vitalRepository->findOrFail($id);
        try{
            $data['updated_by'] = getAuthUser();
            $vitalUpdate = $this->vitalRepository->update($vitals->id,$data);
            $vitals =  $this->vitalRepository->find($id);
            return $vitals;

        }catch(Exception $e){
            throw $e;
        }
    }


    /** Delete an vital
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->vitalRepository->delete($id);
        return true;
    }
}
