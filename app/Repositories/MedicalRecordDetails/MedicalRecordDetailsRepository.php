<?php

namespace App\Repositories\MedicalRecordDetails;

use App\Models\MedicalRecordDetails;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicalRecordDetailsRepository extends Repository
{

    /**
     * MedicalRecordDetailsRepository constructor.
     * @param MedicalRecordDetails $MedicalRecordDetails
     */
    public function __construct(MedicalRecordDetails $MedicalRecordDetails)
    {
        parent::__construct($MedicalRecordDetails);
    }

    /**
     * @param Request $request
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->model->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
