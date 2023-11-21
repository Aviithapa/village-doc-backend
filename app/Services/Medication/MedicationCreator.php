<?php

namespace App\Services\Medication;

use App\Models\Medication;
use App\Repositories\Medication\MedicationRepository;


/**
 * Class  DoctorCreator
 * @package App\Services\Doctor
 */
class MedicationCreator
{
     /**
     * @var MedicationRepository
     */
    protected $medicationRepository;


    /**
     * DoctorGetter constructor.
     * @param MedicationRepository $medicationRepository

     */
    public function __construct(MedicationRepository $medicationRepository)
    {
        $this->medicationRepository = $medicationRepository;
    }

    /**
     * Store an doctor
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $doctor =  $this->medicationRepository->store($data);
        return $doctor->refresh();
    }

    public function bulkStore($data)
    {
        $medications = $data['medication'];

        foreach($medications as $value){
            $value['prescription_id'] = $data['prescription_id'];
            $med = Medication::create($value);
        }
        return $med->refresh();
    }
}