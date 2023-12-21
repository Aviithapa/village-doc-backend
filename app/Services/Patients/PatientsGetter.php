<?php

namespace App\Services\Patients;

use App\Http\Resources\Patients\PatientFamilyResource;
use App\Http\Resources\Patients\PatientsResource;
use App\Models\Patients;
use Illuminate\Http\Request;
use App\Repositories\Patients\PatientsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

/**
 * Class PatientsGetter
 * @package App\Services\Patients
 */
class PatientsGetter
{
    /**
     * @var PatientsRepository
     */
    protected $patientsRepository;

    /**
     * PatientsGetter constructor.
     * @param PatientsRepository $patientsRepository
     */
    public function __construct(PatientsRepository $patientsRepository)
    {
        $this->patientsRepository = $patientsRepository;
    }

    /**
     * Get paginated Patients list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->patientsRepository->getPaginatedList($request);
    }

    /**
     * Get a single Patients
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        $patientDetails = $this->patientsRepository->findOrFail($id);
        $patientDetails->qrCode = $this->generateQR($patientDetails->uuid)->content();
        return $patientDetails;
    }

    /**
     * Get a single Patients Details
     * @param $uuid
     * @return Object|null
     */
    public function patientsDetails($uuid)
    {
        $patient =  Patients::where('uuid', $uuid)->firstOrFail();

        if (!$patient->is_house_head) {
            $patient = Patients::where('is_house_head', true)->where('id', $patient->patient_id)->firstOrFail();
        }

        $factory = JWTFactory::customClaims([
            'sub'   => $patient->uuid
        ]);

        $payload = $factory->make();
        $token = JWTAuth::encode($payload)->get();

        $data = [
            'access_token' => $token,
            'patient_details' => PatientsResource::make($patient)
        ];

        return $data;
    }

    public function showFamilyHead($househead_no)
    {
        return $this->patientsRepository->all()->where('househead_no', $househead_no)->where('is_house_head', 1)->first();
    }

    public function getFamilyHeadDetail($id)
    {
        $patient = $this->patientsRepository->find($id);

        if (!$patient->is_house_head) {
            $patient = Patients::where('is_house_head', true)->where('id', $patient->patient_id)->firstOrFail();
        }

        return $patient;
    }

    public function validatePatient($data)
    {
        $patientDetail = $this->patientsRepository->find($data['patient_id']);

        $familyHeadUUID = JWTAuth::parseToken()->getPayload()->get('sub');

        $familyHeadID = Patients::where('uuid',$familyHeadUUID)->pluck('id')->first();
        if($patientDetail->patient_id && $patientDetail->is_house_head === 0)
        {
            if($patientDetail->patient_id == $familyHeadID)
                return $patientDetail;

        }elseif($patientDetail->id == $familyHeadID){
            return $patientDetail;
        }else{
            throw  new  BadRequestHttpException('Patient Doesnot belong to the family in our record.');          
        }
    }

    public function generateQR($uuid)
    {
        $generatedURL = "https://village-doc-frontend.vercel.app/patient/".$uuid;
        return response(QrCode::size(200)->generate($generatedURL));
    }
}
