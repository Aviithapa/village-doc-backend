<?php

namespace App\Repositories\Address;

use App\Models\Province\Province;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProvinceRepository extends Repository
{

    /**
     * ProvinceRepository constructor.
     * @param Province $province
     */
    public function __construct(Province $province)
    {
        parent::__construct($province);
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
