<?php

namespace App\Services\MedicalRecord;

use App\Client\ChatGPT\ChatGPTService;
use App\Repositories\MedicalRecord\MedicalRecordRepository;

/**
 * Class  MedicalRecordCreator
 * @package App\Services\MedicalRecord
 */
class MedicalRecordCreator
{
    /**
     * @var MedicalRecordRepository
     */
    protected $medicalRecordRepository;

    protected $chatGptService;


    /**
     * MedicalRecordGetter constructor.
     * @param MedicalRecordRepository $medicalRecordRepository
     */
    public function __construct(MedicalRecordRepository $medicalRecordRepository, ChatGPTService $chatGPTService)
    {
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->chatGptService = $chatGPTService;
    }

    /**
     * Store an MedicalRecord
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $chat =  $this->chatGptService->chat($data['diagnosis']);
        dd($chat);
        return $chat;
        // $medicalRecord =  $this->medicalRecordRepository->store($data);
        // return $medicalRecord->refresh();
    }
}
