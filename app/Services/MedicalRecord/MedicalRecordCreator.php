<?php

namespace App\Services\MedicalRecord;

use App\Client\ChatGPT\ChatGPTService;
use App\Models\MedicalRecordDescription;
use App\Models\Prescription;
use App\Repositories\MedicalRecord\MedicalRecordRepository;
use App\Services\Prescription\PrescriptionCreator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
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

    protected $chatGptService, $prescriptionCreator;


    /**
     * MedicalRecordGetter constructor.
     * @param MedicalRecordRepository $medicalRecordRepository
     */
    public function __construct(
        MedicalRecordRepository $medicalRecordRepository,
        ChatGPTService $chatGPTService,
        PrescriptionCreator  $prescriptionCreator
    ) {
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->chatGptService = $chatGPTService;
        $this->prescriptionCreator =  $prescriptionCreator;
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
            $data['created_by'] = Auth::user()->id;
            $medicalRecord = $this->medicalRecordRepository->store($data);

            $prescriptionData = [
                'patient_id' => $data['patient_id'],
                'medical_record_id' => $medicalRecord->id,
                'from' => $data['from'] ?? Prescription::FROM_HEALTH_WORKER,
                'prescription_date' => Carbon::now(),
                'suggested_treatment' => ''
            ];

            if ($data['from'] === Prescription::FROM_AI) {
                $message = "I'm experiencing " . $data['diagnosis']  . " . What could be the possible causes, and what general advice or precautions should I consider? Please note that I understand this is not a substitute for professional medical advice, but I'm looking for general information and suggestions.";
                $chat =  $this->chatGptService->chat($message);
                $prescriptionData['suggested_treatment'] = $chat;
            }

            $this->prescriptionCreator->store($prescriptionData);

            DB::commit();

            return [
                'chat' => $chat ?? null,
                'medicalRecord' => $medicalRecord
            ];
        } catch (Exception $e) {

            DB::rollBack();
            throw $e;
        }
    }

    public function storeMedicalStatus(array $data)
    {
        $medical = MedicalRecordDescription::create($data);
        return $medical->refresh();
    }
}
