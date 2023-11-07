<?php

namespace App\Services\Vital;


use App\Repositories\Vital\VitalRepository;

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
        $vital = $this->vitalRepository->findOrFail($id);
        $this->vitalRepository->store($data);
        return true;
    }


    /** Delete an vital
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        //Todo: Delete vital
        return false;
    }
}
