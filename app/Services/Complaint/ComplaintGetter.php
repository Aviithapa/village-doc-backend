<?php

namespace App\Services\Complaint;

use App\Repositories\Complaint\ComplaintRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ComplaintGetter
 * @package App\Services\Complaint
 */
class ComplaintGetter
{
    protected $complaintRepository;

    /**
     * @var ComplaintRepository
    */

    /**
     * ComplaintGetter constructor.
     * @param ComplaintRepository $ComplaintRepository
     */
    public function __construct(ComplaintRepository $complaintRepository)
    {
        $this->complaintRepository = $complaintRepository;
    }

    /**
     * Get paginated Complaint list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request): LengthAwarePaginator
    {
        return $this->complaintRepository->getPaginatedList($request);
    }

    /**
     * Get a single Complaint
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->complaintRepository->findOrFail($id);
    }

}
