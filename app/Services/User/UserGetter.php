<?php

namespace App\Services\User;


use Illuminate\Http\Request;
use App\Repositories\Apartment\ApartmentRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ApartmentGetter
 * @package App\Services\Apartment
 */
class UserGetter
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ApartmentGetter constructor.
     * @param ApartmentRepository $apartmentRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {

        return $this->userRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        $userData = $this->userRepository->findOrFail($id);
        return $userData;
    }
}
