<?php

namespace App\Services\Pilccod;


use App\Repositories\Pilccod\PilccodRepository;
use Exception;

/**
 * Class  PilccodUpdater
 * @package App\Services\Pilccod
 */
class PilccodUpdater
{
    /**
     * @var PilccodRepository
     */
    protected $PilccodRepository;



    /**
     * PilccodGetter constructor.
     * @param PilccodRepository $PilccodRepository
     */
    public function __construct(PilccodRepository $PilccodRepository)
    {
        $this->PilccodRepository = $PilccodRepository;
    }

    /**
     * Store an Pilccod
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $Pilccods = $this->PilccodRepository->findOrFail($id);
        try {
            $data['updated_by'] = getAuthUser();
            $PilccodUpdate = $this->PilccodRepository->update($Pilccods->id, $data);
            $Pilccods =  $this->PilccodRepository->find($id);
            return $Pilccods;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /** Delete an Pilccod
     * @param int $id
     * @return false
     */
    public function destroy(int $id)
    {
        $this->PilccodRepository->delete($id);
        return true;
    }
}
