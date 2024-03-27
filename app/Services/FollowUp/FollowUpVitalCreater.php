<?php

namespace App\Services\FollowUp;

use App\Models\FollowUp;
use App\Repositories\FollowUpVital\FollowUpVitalRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class FollowUpVitalCreater
{
    protected $followUpVitalRepository;

    public function __construct(FollowUpVitalRepository $followUpVitalRepository)
    {
        $this->followUpVitalRepository = $followUpVitalRepository;
    }


    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $followupVital =  $this->followUpVitalRepository->store($data);
            DB::commit();
            return $followupVital;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
