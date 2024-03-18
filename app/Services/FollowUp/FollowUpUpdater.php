<?php

namespace App\Services\FollowUp;

use App\Repositories\FollowUp\FollowUpRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class  FollowUpUpdater
 * @package App\Services\FollowUp
 */
class FollowUpUpdater
{
    protected $followupRepository;
    /**
     * @var FollowUpRepository
     */

    /**
     * FollowUpUpdater constructor.
     * @param FollowUpRepository $followupRepository
     */
    public function __construct(FollowUpRepository $followupRepository)
    {
        $this->followupRepository = $followupRepository;
    }

    /**
     * Update an FollowUp
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $followup = $this->followupRepository->find($id);
        try {
            DB::beginTransaction();
            $followup =  $this->followupRepository->update($id, $data);
            DB::commit();
            $followup = $this->followupRepository->find($id);
            return $followup->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        $followup = $this->followupRepository->delete($id);
        return true;
    }
}
