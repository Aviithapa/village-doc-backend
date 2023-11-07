<?php

namespace App\Services\LabResult;


use App\Repositories\LabResult\LabResultRepository;

/**
 * Class  LabResultCreator
 * @package App\Services\LabResult
 */
class LabResultCreator
{
    /**
     * @var LabResultRepository
     */
    protected $labResultRepository;


    /**
     * LabResultGetter constructor.
     * @param LabResultRepository $labResultRepository
     */
    public function __construct(LabResultRepository $labResultRepository)
    {
        $this->labResultRepository = $labResultRepository;
    }

    /**
     * Store an LabResult
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $labResult =  $this->labResultRepository->store($data);
        return $labResult->refresh();
    }
}
