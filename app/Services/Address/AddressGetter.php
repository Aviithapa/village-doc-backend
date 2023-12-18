<?php

namespace App\Services\Address;

use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\DistrictRepository;
use App\Repositories\Address\MunicipalityRepository;
use App\Repositories\Address\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AddressGetter
 * @package App\Services\Address
 */
class AddressGetter
{
    protected $provinceRepository, $districtRepository, $municipalityRepository;

    /**
     * @var AddressRepository
     */

    /**
     * AddressGetter constructor.
     * @param ProvinceRepository $provinceRepository, 
     * @param DistrictRepository $districtRepository, 
     * @param MunicipalityRepository $municipalityRepository
     */
    public function __construct(
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        MunicipalityRepository $municipalityRepository
    ) {
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->municipalityRepository = $municipalityRepository;
    }

    public function getAddress()
    {
        $province = $this->provinceRepository->all();
        $district = $this->districtRepository->all();
        $municipality = $this->municipalityRepository->all();

        return [
            'province' => $province,
            'district' => $district,
            'municipality' => $municipality
        ];
    }
}
