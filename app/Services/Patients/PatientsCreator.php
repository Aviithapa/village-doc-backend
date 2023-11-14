<?php

namespace App\Services\Patients;

use App\Client\ChatGPT\ChatGPTService;
use App\Repositories\Patients\PatientsRepository;
use App\Services\Vital\VitalCreator;
use Illuminate\Support\Str;

/**
 * Class  PatientsCreator
 * @package App\Services\Patients
 */
class PatientsCreator
{
    /**
     * @var PatientsRepository
     */
    protected $patientsRepository;

    protected $vitalCreator;

    protected $chatGptService;

    /**
     * PatientsGetter constructor.
     * @param PatientsRepository $patientsRepository
     * @param VitalCreator $vitalCreator
     */
    public function __construct(PatientsRepository $patientsRepository, VitalCreator $vitalCreator, ChatGPTService $chatGPTService)
    {
        $this->patientsRepository = $patientsRepository;
        $this->vitalCreator = $vitalCreator;
        $this->chatGptService = $chatGPTService;
    }

    /**
     * Store an patients
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['uuid'] = Str::uuid()->toString();
        $patients =  $this->patientsRepository->store($data);
        return $patients->refresh();
    }
}
