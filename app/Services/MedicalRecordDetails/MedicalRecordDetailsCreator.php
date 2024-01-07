<?php

namespace App\Services\MedicalRecordDetails;


use App\Repositories\MedicalRecordDetails\MedicalRecordDetailsRepository;


/**
 * Class  MedicalRecordDetailsCreator
 * @package App\Services\MedicalRecordDetails
 */
class MedicalRecordDetailsCreator
{
    /**
     * @var MedicalRecordDetailsRepository
     */
    protected $MedicalRecordDetailsRepository;


    /**
     * MedicalRecordDetailsGetter constructor.
     * @param MedicalRecordDetailsRepository $MedicalRecordDetailsRepository
     */
    public function __construct(MedicalRecordDetailsRepository $MedicalRecordDetailsRepository)
    {
        $this->MedicalRecordDetailsRepository = $MedicalRecordDetailsRepository;
    }

    /**
     * Store an MedicalRecordDetails
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $MedicalRecordDetails =  $this->MedicalRecordDetailsRepository->store($data);
        return $MedicalRecordDetails;
    }
}
