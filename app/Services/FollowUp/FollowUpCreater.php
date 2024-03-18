<?php

namespace App\Services\FollowUp;

use App\Models\FollowUp;
use App\Repositories\FollowUp\FollowUpRepository;
use App\Repositories\FollowUp\FollowUpVitalRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class FollowUpCreater
{
    protected $followUpRepository, $followupVitalCreator;

    public function __construct(FollowUpRepository $followUpRepository, FollowUpVitalCreater $followupVitalCreator)
    {
        $this->followUpRepository = $followUpRepository;
        $this->followupVitalCreator = $followupVitalCreator;
    }


    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $followup =  $this->followUpRepository->store($data);

            if (!empty($data['followup_vital'])) {
                $FollowupVitalData = $data['followup_vital'];
                foreach ($FollowupVitalData as $key => $vitalData) {
                    $FollowupVitalData[$key]['follow_up_id'] = $followup->id;
                }
                $this->followupVitalCreator->insert($FollowupVitalData);
            }
            DB::commit();
            return $followup->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
