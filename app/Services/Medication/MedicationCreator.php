<?php

namespace App\Services\Medication;

use App\Repositories\Medication\MedicationRepository;


/**
 * Class  MedicationCreator
 * @package App\Services\Medication
 */
class MedicationCreator
{
     /**
     * @var MedicationRepository
     */
    protected $medicationRepository;


    /**
     * MedicationCreator constructor.
     * @param MedicationRepository $medicationRepository

     */
    public function __construct(MedicationRepository $medicationRepository)
    {
        $this->medicationRepository = $medicationRepository;
    }

    /**
     * Store an medication
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $medication =  $this->medicationRepository->store($data);
        return $medication->refresh();
    }

    public function bulkStore($data)
    {
        $medications = $data['medication'];

        foreach($medications as $key => $value){
            $medications[$key]['prescription_id'] = $data['prescription_id'];
        }
        $medications =  $this->medicationRepository->insert($medications);
        return $medications;
    }
}