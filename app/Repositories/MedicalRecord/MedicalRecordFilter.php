<?php

namespace App\Repositories\MedicalRecord;

use App\Infrastructure\Filters\BaseFilter;
use Carbon\Carbon;

class MedicalRecordFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['keyword', 'type', 'status', 'name', 'month', 'year', 'start_date'];


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

    public function year()
    {
        if ($this->request->has('year')) {
            $this->builder->where('created_at', 'LIKE', $this->request->get('year') . '%');
        }
    }

    public function month()
    {
        if ($this->request->has('month')) {
            $year = $this->request->get('year') ?? Carbon::now()->year;
            $yearMonthFilter = $year . '-' . $this->request->get('month');
            $this->builder->where('created_at', 'LIKE', $yearMonthFilter . '%');
        }
    }

    public function startDate()
    {
        if ($this->request->has('start_date') && $this->request->has('end_date')) {
            $startDate =  $this->request->get('start_date');
            $endDate =  $this->request->get('end_date');
            $this->builder->whereBetween('created_at', [$startDate, $endDate])->get();
        }
    }
}
