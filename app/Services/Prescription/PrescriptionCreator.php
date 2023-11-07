<?php

namespace App\Services\Prescription;


use App\Repositories\Prescription\PrescriptionRepository;

/**
 * Class  PrescriptionCreator
 * @package App\Services\Prescription
 */
class PrescriptionCreator
{
    /**
     * @var PrescriptionRepository
     */
    protected $prescriptionRepository;


    /**
     * PrescriptionGetter constructor.
     * @param PrescriptionRepository $prescriptionRepository
     */
    public function __construct(PrescriptionRepository $prescriptionRepository)
    {
        $this->prescriptionRepository = $prescriptionRepository;
    }

    /**
     * Store an prescription
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $prescription =  $this->prescriptionRepository->store($data);
        return $prescription->refresh();
    }
}
