<?php

namespace App\Services\Patients;

use App\Client\ChatGPT\ChatGPTService;
use App\Client\FileUpload\FileUploaderInterface;
use App\Client\FileUpload\LocalFileUploader;
use App\Models\Medias;
use App\Repositories\Media\MediaRepository;
use App\Repositories\Patients\PatientsRepository;
use App\Services\Vital\VitalCreator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    protected $fileUploader;
    protected $mediaRepository;

    /**
     * PatientsGetter constructor.
     * @param PatientsRepository $patientsRepository
     * @param VitalCreator $vitalCreator
     */
    public function __construct(
        PatientsRepository $patientsRepository,
        VitalCreator $vitalCreator,
        ChatGPTService $chatGPTService,
        FileUploaderInterface $fileUploader,
        MediaRepository $mediaRepository,
    ) {
        $this->patientsRepository = $patientsRepository;
        $this->vitalCreator = $vitalCreator;
        $this->chatGptService = $chatGPTService;
        $this->fileUploader = $fileUploader;
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Store an patients
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $checkFamilyHead = $this->checkFamilyHead($data);
            if ($checkFamilyHead){
                $data['patient_id'] = $checkFamilyHead;
                $data['is_house_head'] = 0;
            }
            $data['created_by'] = getAuthUser();
            $data['uuid'] = Str::uuid()->toString();

            $patients =  $this->patientsRepository->store($data);
            if(isset($data['images'])){
                $response =  $this->fileUploader->uploadBase64($data['images'], "photos");
                $response['type'] = Medias::TYPE_PHOTO;
                $response['patient_id'] = $patients->id;
                $this->mediaRepository->store($response);
            }
            DB::commit();
            return $patients->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function checkFamilyHead($data)
    {
        $getData  = $this->patientsRepository->all()->where('contact_number', $data['househead_no'])->where('is_house_head', 1)->pluck('id')->first();
        return $getData;
    }
}
