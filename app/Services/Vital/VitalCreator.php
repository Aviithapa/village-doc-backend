<?php

namespace App\Services\Vital;


use App\Repositories\Vital\VitalRepository;
use Carbon\Carbon;

/**
 * Class  VitalCreator
 * @package App\Services\Vital
 */
class VitalCreator
{
    /**
     * @var VitalRepository
     */
    protected $vitalRepository;

    protected $fileUploader;

    protected $addressCreator;

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
    public function store(array $data)
    {
        $vital =  $this->vitalRepository->store($data);
        return $vital;
    }
}
