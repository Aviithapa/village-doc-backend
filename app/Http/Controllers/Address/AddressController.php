<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\Address\AddressGetter;
use Illuminate\Http\Request;


class AddressController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AddressGetter $dataGetter)
    {
        return  $dataGetter->getAddress();
    }
}
