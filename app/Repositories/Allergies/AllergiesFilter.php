<?php

namespace App\Repositories\Allergies;

use App\Infrastructure\Filters\BaseFilter;

class AllergiesFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['allergenName'];



    public function allergenName()
    {
        if ($this->request->has('allergen_name')) {
            $this->builder->where('allergen_name', 'LIKE', '%' . $this->request->get('allergen_name') . '%');
        }
    }
}
