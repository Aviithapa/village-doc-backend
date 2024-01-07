<?php

namespace App\Repositories\Examination;

use App\Models\Examination;
use App\Models\Examinations;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ExaminationRepository extends Repository
{

    /**
     * ExaminationRepository constructor.
     * @param Examination $Examination
     */
    public function __construct(Examinations $examination)
    {
        parent::__construct($examination);
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
