<?php

namespace App\Services\Allergies;


use App\Repositories\Allergies\AllergiesRepository;
use Carbon\Carbon;

/**
 * Class  AllergiesCreator
 * @package App\Services\Allergies
 */
class AllergiesCreator
{
    /**
     * @var AllergiesRepository
     */
    protected $allergiesRepository;

    /**
     * AllergiesGetter constructor.
     * @param AllergiesRepository $AllergiesRepository
     */
    public function __construct(AllergiesRepository $allergiesRepository)
    {
        $this->allergiesRepository = $allergiesRepository;
    }

    /**
     * Store an Allergies
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $allergies = $data['allergies'];
        $patientId = $data['patient_id'];

        $bulkInsertData = [];

        foreach ($allergies as $allergic) {
            $bulkInsertData[] = [
                'allergen_name' => $allergic['allergen_name'],
                'reaction' => $allergic['reaction'],
                'patient_id' => $patientId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        $allergies =  $this->allergiesRepository->insert($bulkInsertData);
        return $allergies;
    }
}
