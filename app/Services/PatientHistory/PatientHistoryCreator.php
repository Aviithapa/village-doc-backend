<?php

namespace App\Services\PatientHistory;


use App\Repositories\PatientHistory\PatientHistoryRepository;


/**
 * Class  PatientHistoryCreator
 * @package App\Services\PatientHistory
 */
class PatientHistoryCreator
{
    /**
     * @var PatientHistoryRepository
     */
    protected $PatientHistoryRepository;


    /**
     * PatientHistoryGetter constructor.
     * @param PatientHistoryRepository $PatientHistoryRepository
     */
    public function __construct(PatientHistoryRepository $PatientHistoryRepository)
    {
        $this->PatientHistoryRepository = $PatientHistoryRepository;
    }

    /**
     * Store an PatientHistory
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $PatientHistory =  $this->PatientHistoryRepository->store($data);
        return $PatientHistory;
    }
}
