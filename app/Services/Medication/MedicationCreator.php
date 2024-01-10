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
        $data['created_by'] = getAuthUser();
        $medication =  $this->medicationRepository->store($data);
        return $medication->refresh();
    }

    public function bulkStore($data)
    {
        $medications = $data['medication'];

        // dd($data);
        foreach ($medications as $key => $value) {
            $medications[$key]['medical_record_id'] = $data['medical_record_id'];
            $medications[$key]['created_by'] = getAuthUser();
        }
        $medications =  $this->medicationRepository->insert($medications);
        return $medications;
    }
}
