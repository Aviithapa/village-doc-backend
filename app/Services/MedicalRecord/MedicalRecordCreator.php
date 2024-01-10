<?php

namespace App\Services\MedicalRecord;

use App\Client\ChatGPT\ChatGPTService;
use App\Models\MedicalRecordDescription;
use App\Models\Pilccod;
use App\Models\Prescription;
use App\Repositories\MedicalRecord\MedicalRecordRepository;
use App\Services\Alcohol\AlcoholCreator;
use App\Services\Allergies\AllergiesCreator;
use App\Services\Appointment\AppointmentCreator;
use App\Services\BMI\BmiCreator;
use App\Services\Examination\ExaminationCreator;
use App\Services\MedicalRecordDetails\MedicalRecordDetailsCreator;
use App\Services\MenstrualHistory\MenstrualHistoryCreator;
use App\Services\ObstreticHistory\ObstreticHistoryCreator;
use App\Services\PackYear\PackYearCreator;
use App\Services\PatientHistory\PatientHistoryCreator;
use App\Services\Pilccod\PilccodCreator;
use App\Services\Prescription\PrescriptionCreator;
use App\Services\Vital\VitalCreator;
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
        $cheifComplainCreator, $vitalsCreator, $packYearCreator,
        $alcoholUnitCreator, $bmiCreator, $appointmentCreator;


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
        VitalCreator $vitalsCreator,
        PackYearCreator $packYearCreator,
        AlcoholCreator $alcoholUnitCreator,
        BmiCreator $bmiCreator,
        AppointmentCreator $appointmentCreator
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
        $this->vitalsCreator = $vitalsCreator;
        $this->packYearCreator = $packYearCreator;
        $this->alcoholUnitCreator = $alcoholUnitCreator;
        $this->bmiCreator = $bmiCreator;
        $this->appointmentCreator = $appointmentCreator;
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
                $message = "I'm experiencing " . $data['medical_record_details']['hopi']  . " . What could be the possible causes, and what general advice or precautions should I consider? Please note that I understand this is not a substitute for professional medical advice, but I'm looking for general information and suggestions.";
                $chat =  $this->chatGptService->chat($message);
                $prescriptionData['suggested_treatment'] = $chat;
            }

            if (!empty($data['examination'])) {
                $examinationData = $data['examination'];
                $examinationData['medical_record_id'] = $medicalRecord->id;
                $examinationData['from'] = Prescription::FROM_HEALTH_WORKER;
                $this->examinationCreator->store($examinationData);
            }

            if (!empty($data['medical_record_details'])) {
                $medicalRecordDetailsData = $data['medical_record_details'];
                $medicalRecordDetailsData['medical_record_id'] = $medicalRecord->id;
                $medicalRecordDetailsData['from'] = Prescription::FROM_HEALTH_WORKER;
                $this->medicalRecordDetailsCreator->store($medicalRecordDetailsData);
            }

            if (!empty($data['pilccod'])) {
                $pilccodData = $data['pilccod'];
                $pilccodData['medical_record_id'] = $medicalRecord->id;
                $this->pilccodCreator->store($pilccodData);
            }

            if (!empty($data['chief_complaint'])) {
                $chiefComplaintData = $data['chief_complaint'];
                foreach ($chiefComplaintData as $key => $complaintsData) {
                    $chiefComplaintData[$key]['medical_record_id'] = $medicalRecord->id;
                }
                $this->cheifComplainCreator->insert($chiefComplaintData);
            }

            if (!empty($data['patient_history'])) {
                $patientHistoryData = $data['patient_history'];
                $patientHistoryData['medical_record_id'] = $medicalRecord->id;
                $this->patientHistoryCreator->store($patientHistoryData);
            }
            if (!empty($data['patient_history']['personal_history']['pack_year'])) {
                $packYearData = $data['patient_history']['personal_history']['pack_year'];
                $packYearData['patient_id'] = $data['patient_id'];
                $packYearData['medical_record_id'] = $medicalRecord->id;
                $this->packYearCreator->store($packYearData);
            }
            if (!empty($data['patient_history']['personal_history']['units_per_week'])) {
                $alcoholUnitData = $data['patient_history']['personal_history']['units_per_week'];
                $alcoholUnitData['patient_id'] = $data['patient_id'];
                $alcoholUnitData['medical_record_id'] = $medicalRecord->id;
                $this->alcoholUnitCreator->store($alcoholUnitData);
            }
            if (!empty($data['bmi'])) {
                $bmiData = $data['bmi'];
                $bmiData['patient_id'] = $data['patient_id'];
                $bmiData['medical_record_id'] = $medicalRecord->id;
                $this->bmiCreator->store($bmiData);
            }

            if (!empty($data['allergies'])) {
                $allergyData = [
                    'allergies' => $data['allergies'],
                    'patient_id' => $data['patient_id']
                ];
                $this->allergyCreator->store($allergyData);
            }

            if (!empty($data['vitals'])) {
                $vitalsData = $data['vitals'];
                $vitalsData['medical_record_id'] = $medicalRecord->id;
                $this->vitalsCreator->store($vitalsData);
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

            if ($data['from'] === Prescription::FROM_APPOINTMENT) {
                $appointmentData['medical_record_id'] = $medicalRecord->id;
                $appointmentData['appointment_date'] = Carbon::now();
                $appointmentData['appointment_time'] = $appointmentData['appointment_date']->addHour();
                $appointmentData['status'] = 'QUERIED';
                $appointmentData['reason'] = "Appoinment Booked";
                $this->appointmentCreator->store($appointmentData);
                $prescriptionData['from'] = Prescription::FROM_HEALTH_WORKER;
            }

            $this->prescriptionCreator->store($prescriptionData);

            DB::commit();

            return [
                'chat' => $chat ?? null,
                'medical_record' => $medicalRecord
            ];
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            throw $e;
        }
    }


    public function storeMedicalStatus(array $data)
    {
        $medical = MedicalRecordDescription::create($data);
        return $medical->refresh();
    }
}
