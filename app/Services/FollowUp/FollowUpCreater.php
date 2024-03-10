<?php

namespace App\Services\FollowUp;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class  FollowUpCreator
 * @package App\Services\MedicalRecord
 */
class FollowUpCreator
{
    /**
     * @var FollowUpRepository
     */
    protected $followUpRepository;

    protected  $followUpCreator;


    /**
     * MedicalRecordGetter constructor.
     * @param FollowUpRepository $followUpRepository
     */
    public function __construct(

        FollowUpCreater $followUpCreator
    ) {

        $this->followUpCreator = $followUpCreator;
    }

    /**
     * Store an FollowUp
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            // first store followup then create follow up vitals using followup id
            $data['created_by'] = getAuthUser();
            $followUp = $this->followUpRepository->store($data);



            if (!empty($data['examination'])) {
                $examinationData = $data['examination'];
                $examinationData['medical_record_id'] = $followUp->id;
                $this->followUpCreator->store($examinationData);
            }

            DB::commit();

            return [
                'chat' => $chat ?? null,
                'medical_record' => $followUp
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
