<?php

namespace App\Services\LabResult;


use App\Repositories\LabResult\LabResultRepository;
use App\Client\FileUpload\FileUploaderInterface;
use App\Models\Medias;
use App\Repositories\Media\MediaRepository;

/**
 * Class  LabResultCreator
 * @package App\Services\LabResult
 */
class LabResultCreator
{
    /**
     * @var LabResultRepository
     */
    protected $labResultRepository;
    protected $fileUploader;
    protected $mediaRepository;
    
    /**
     * LabResultGetter constructor.
     * @param LabResultRepository $labResultRepository
     */
    public function __construct(
        LabResultRepository $labResultRepository,
        FileUploaderInterface $fileUploader,
        MediaRepository $mediaRepository
    )
    {
        $this->labResultRepository = $labResultRepository;
        $this->fileUploader = $fileUploader;
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Store an LabResult
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $response =  $this->fileUploader->upload($data['image'], "photos");
        $response['type'] = Medias::TYPE_PHOTO;

        $labResult =  $this->labResultRepository->store($data);
        $response['patient_id'] = $data['patient_id'];
        $this->mediaRepository->store($response);

        return $labResult->refresh();
    }
}
