<?php

namespace App\Repositories\Appointment;

use App\Infrastructure\Filters\BaseFilter;

class AppointmentFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['keyword', 'type', 'status', 'name'];


    /**
     * keyword
     *
     * @return void
     */
    public function keyword()
    {
        if ($this->request->has('keyword')) {
            $keyword = $this->request->get('keyword');
            $this->builder->where(function ($query) use ($keyword) {
                $query->where('first_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('date_of_birth', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('contact_number', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('address', 'LIKE', '%' . $keyword . '%');
            });
        }
    }


    public function type()
    {
        if ($this->request->has('type')) {
            $this->builder->where('type', $this->request->get('type'));
        }
    }

    public function status()
    {
        if ($this->request->has('status')) {
            $this->builder->where('status', $this->request->get('status'));
        }
    }

    public function name()
    {
        if ($this->request->has('name')) {
            $this->builder->where('name', 'LIKE', '%' . $this->request->get('name') . '%');
        }
    }
}
