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
        $vitals = $data['vitals'];
        $dateOfMeasurement = $data['date_of_measurement'];
        $patientId = $data['patient_id'];

        $bulkInsertData = [];

        foreach ($vitals as $vital) {
            $bulkInsertData[] = [
                'name' => $vital['name'],
                'measurement' => $vital['measurement'],
                'date_of_measurement' => $dateOfMeasurement,
                'patient_id' => $patientId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => getAuthUser()
            ];
        }
        $vital =  $this->vitalRepository->insert($bulkInsertData);
        return $vital;
    }
}
