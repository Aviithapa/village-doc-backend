<?php

namespace App\Services\Patients;

use App\Http\Resources\Patients\PatientsResource;
use App\Models\Patients;
use Illuminate\Http\Request;
use App\Repositories\Patients\PatientsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        return $this->patientsRepository->findOrFail($id);
    }

    /**
     * Get a single Patients Details
     * @param $uuid
     * @return Object|null
     */
    public function patientsDetails($uuid)
    {
        $patient =  Patients::where('uuid', $uuid)->firstOrFail();

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
}
