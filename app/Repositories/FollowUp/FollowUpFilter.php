<?php

namespace App\Repositories\FollowUp;

use App\Infrastructure\Filters\BaseFilter;

class FollowUpFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['date', 'medical_record_id'];


    /**
     * keyword
     *
     * @return void
     */
    public function date()
    {
        if ($this->request->has('date')) {
            $this->builder->where('date', $this->request->get('date'));
        }
    }


    public function medical_record_id()
    {
        if ($this->request->has('medical_record_id')) {
            $this->builder->where('medical_record_id', $this->request->get('medical_record_id'));
        }
    }
}
