<?php

namespace App\Repositories\Address;

use App\Models\Province\Municipality;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MunicipalityRepository extends Repository
{

    /**
     * MunicipalityRepository constructor.
     * @param Municipality $municipality
     */
    public function __construct(Municipality $municipality)
    {
        parent::__construct($municipality);
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
