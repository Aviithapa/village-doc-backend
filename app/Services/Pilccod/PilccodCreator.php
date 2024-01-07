<?php

namespace App\Services\Pilccod;


use App\Repositories\Pilccod\PilccodRepository;


/**
 * Class  PilccodCreator
 * @package App\Services\Pilccod
 */
class PilccodCreator
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
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $Pilccod =  $this->PilccodRepository->store($data);
        return $Pilccod;
    }
}
