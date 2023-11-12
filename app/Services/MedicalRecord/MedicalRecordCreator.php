<?php

namespace App\Services\MedicalRecord;

use App\Client\ChatGPT\ChatGPTService;
use App\Repositories\MedicalRecord\MedicalRecordRepository;
use Exception;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $chat =  $this->chatGptService->chat($data['diagnosis']);
            $this->medicalRecordRepository->store($data);
            DB::commit();
            return $chat;
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            DB::rollBack();
            return $e;
        }
    }
}
