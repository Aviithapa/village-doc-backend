<?php

namespace App\Repositories\MenstrualHistory;

use App\Models\MenstrualHistory;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MenstrualHistoryRepository extends Repository
{

    /**
     * MenstrualHistoryRepository constructor.
     * @param MenstrualHistory $MenstrualHistory
     */
    public function __construct(MenstrualHistory $MenstrualHistory)
    {
        parent::__construct($MenstrualHistory);
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
