<?php

namespace App\Repositories\Pilccod;

use App\Models\Pilccod;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PilccodRepository extends Repository
{

    /**
     * PilccodRepository constructor.
     * @param Pilccod $Pilccod
     */
    public function __construct(Pilccod $pilccod)
    {
        parent::__construct($pilccod);
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
