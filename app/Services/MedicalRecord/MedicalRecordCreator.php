<?php

namespace App\Services\MedicalRecord;

use App\Client\ChatGPT\ChatGPTService;
use App\Models\MedicalRecordDescription;
use App\Models\Pilccod;
use App\Models\Prescription;
use App\Repositories\MedicalRecord\MedicalRecordRepository;
use App\Services\Allergies\AllergiesCreator;
use App\Services\Examination\ExaminationCreator;
use App\Services\MedicalRecordDetails\MedicalRecordDetailsCreator;
use App\Services\MenstrualHistory\MenstrualHistoryCreator;
use App\Services\ObstreticHistory\ObstreticHistoryCreator;
use App\Services\PatientHistory\PatientHistoryCreator;
use App\Services\Pilccod\PilccodCreator;
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

    protected $chatGptService, $prescriptionCreator,
        $pilccodCreator, $patientHistoryCreator,
        $allergyCreator, $menstrualHistoryCreator, $obstreticHistoryCreator,
        $examinationCreator, $medicalRecordDetailsCreator,
        $cheifComplainCreator;


    /**
     * MedicalRecordGetter constructor.
     * @param MedicalRecordRepository $medicalRecordRepository
     */
    public function __construct(
        MedicalRecordRepository $medicalRecordRepository,
        ChatGPTService $chatGPTService,
        PrescriptionCreator  $prescriptionCreator,
        PilccodCreator $pilccodCreator,
        PatientHistoryCreator $patientHistoryCreator,
        AllergiesCreator $allergiesCreator,
        MenstrualHistoryCreator $menstrualHistoryCreator,
        ObstreticHistoryCreator $obstreticHistoryCreator,
        ExaminationCreator $examinationCreator,
        MedicalRecordDetailsCreator $medicalRecordDetailsCreator,
        MedicalRecordComplaintCreator $cheifComplainCreator,
    ) {
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->chatGptService = $chatGPTService;
        $this->prescriptionCreator =  $prescriptionCreator;
        $this->pilccodCreator = $pilccodCreator;
        $this->patientHistoryCreator = $patientHistoryCreator;
        $this->allergyCreator = $allergiesCreator;
        $this->menstrualHistoryCreator = $menstrualHistoryCreator;
        $this->obstreticHistoryCreator = $obstreticHistoryCreator;
        $this->examinationCreator = $examinationCreator;
        $this->medicalRecordDetailsCreator = $medicalRecordDetailsCreator;
        $this->cheifComplainCreator = $cheifComplainCreator;
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
            $data['created_by'] = getAuthUser();
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

            if (!empty($data['examination'])) {
                $examinationData = $data['examination'];
                $examinationData['medical_record_id'] = $medicalRecord->id;
                $this->examinationCreator->store($examinationData);
            }

            if (!empty($data['medical_record_details'])) {
                $medicalRecordDetailsData = $data['medical_record_details'];
                $medicalRecordDetailsData['medical_record_id'] = $medicalRecord->id;
                $this->medicalRecordDetailsCreator->store($medicalRecordDetailsData);
            }

            if (!empty($data['pilccod'])) {
                $pilccodData = $data['pilccod'];
                $pilccodData['medical_record_id'] = $medicalRecord->id;
                $this->pilccodCreator->store($pilccodData);
            }

            if (!empty($data['chief_complaint'])) {
                $chiefComplaintData = $data['chief_complaint'];
                $chiefComplaintData['medical_record_id'] = $medicalRecord->id;
                $this->cheifComplainCreator->store($chiefComplaintData);
            }

            if (!empty($data['patient_history'])) {
                $patientHistoryData = $data['patient_history'];
                $patientHistoryData['medical_record_id'] = $medicalRecord->id;
                $this->patientHistoryCreator->store($patientHistoryData);
            }

            if (!empty($data['allergies'])) {
                $allergyData = [
                    'allergies' => $data['allergies'],
                    'patient_id' => $data['patient_id']
                ];
                $this->allergyCreator->store($allergyData);
            }

            if (!empty($data['menstrual_history'])) {
                $menstrualHistoryData = $data['menstrual_history'];
                $menstrualHistoryData['patient_id'] = $data['patient_id'];
                $menstrualHistoryData['medical_record_id'] = $medicalRecord->id;
                $this->menstrualHistoryCreator->store($menstrualHistoryData);
            }

            if (!empty($data['obstetric_history'])) {
                $obstetricHistoryData = $data['obstetric_history'];
                $obstetricHistoryData['patient_id'] = $data['patient_id'];
                $obstetricHistoryData['medical_record_id'] = $medicalRecord->id;
                $this->obstreticHistoryCreator->store($obstetricHistoryData);
            }

            $this->prescriptionCreator->store($prescriptionData);

            DB::commit();

            return [
                'chat' => $chat ?? null,
                'medical_record' => $medicalRecord
            ];
        } catch (Exception $e) {
            dd($e);
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
