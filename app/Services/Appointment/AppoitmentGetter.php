<?php

namespace App\Services\Appointment;

use Illuminate\Http\Request;
use App\Repositories\Appointment\AppointmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AppointmentGetter
 * @package App\Services\Appointment
 */
class AppointmentGetter
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentGetter constructor.
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Get paginated appointment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->appointmentRepository->getPaginatedList($request);
    }

    /**
     * Get a single appointment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->appointmentRepository->findOrFail($id);
    }
}
