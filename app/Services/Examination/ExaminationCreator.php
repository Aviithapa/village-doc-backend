<?php

namespace App\Services\Examination;


use App\Repositories\Examination\ExaminationRepository;


/**
 * Class  ExaminationCreator
 * @package App\Services\Examination
 */
class ExaminationCreator
{
    /**
     * @var ExaminationRepository
     */
    protected $ExaminationRepository;


    /**
     * ExaminationGetter constructor.
     * @param ExaminationRepository $ExaminationRepository
     */
    public function __construct(ExaminationRepository $ExaminationRepository)
    {
        $this->ExaminationRepository = $ExaminationRepository;
    }

    /**
     * Store an Examination
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['created_by'] = getAuthUser();
        $Examination =  $this->ExaminationRepository->store($data);
        return $Examination;
    }
}
