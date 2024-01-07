<?php

namespace App\Repositories\ObstreticHistory;

use App\Models\ObstreticHistory;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ObstreticHistoryRepository extends Repository
{

    /**
     * ObstreticHistoryRepository constructor.
     * @param ObstreticHistory $ObstreticHistory
     */
    public function __construct(ObstreticHistory $ObstreticHistory)
    {
        parent::__construct($ObstreticHistory);
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
