<?php

namespace Octopy\Indonesian\Boundaries\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Octopy\Indonesian\Boundaries\Models\CityGeometry;
use Octopy\Indonesian\Boundaries\Models\VillageGeometry;
use Octopy\Indonesian\Boundaries\Models\ProvinceGeometry;
use Octopy\Indonesian\Boundaries\Models\DistrictGeometry;

class BoundaryController extends Controller
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * BoundaryController constructor.
     * @param  Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        if ($this->hasType('prov')) {
            return $this->province(
                App::make(ProvinceGeometry::class)
            );
        } elseif ($this->hasType('city')) {
            return $this->city(
                App::make(CityGeometry::class)
            );
        } elseif ($this->hasType('dist')) {
            return $this->district(
                App::make(DistrictGeometry::class)
            );
        } elseif ($this->hasType('vill')) {
            return $this->village(
                App::make(VillageGeometry::class)
            );
        }
    }

    /**
     * @param  ProvinceGeometry $geometry
     * @return mixed
     */
    protected function province(ProvinceGeometry $geometry)
    {
        if (is_string($province = $this->request->input('data'))) {
            $province = array_map(fn($province) => trim($province), explode(',', $province));
        }

        if (in_array('all', $province)) {
            return $geometry->get();
        }

        return $geometry->search($province);
    }

    /**
     * @param  CityGeometry $geometry
     * @return mixed
     */
    protected function city(CityGeometry $geometry)
    {
        if (is_string($city = $this->request->input('data'))) {
            $city = array_map(fn($city) => trim($city), explode(',', $city));
        }

        if (in_array('all', $city)) {
            return $geometry->get();
        }

        return $geometry->search($city);
    }

    /**
     * @param  DistrictGeometry $geometry
     * @return mixed
     */
    protected function district(DistrictGeometry $geometry)
    {
        if (is_string($district = $this->request->input('data'))) {
            $district = array_map(fn($district) => trim($district), explode(',', $district));
        }

        if (in_array('all', $district)) {
            return $geometry->get();
        }

        return $geometry->search($district);
    }

    /**
     * @param  VillageGeometry $geometry
     * @return mixed
     */
    protected function village(VillageGeometry $geometry)
    {
        if (is_string($village = $this->request->input('data'))) {
            $village = array_map(fn($village) => trim($village), explode(',', $village));
        }

        if (in_array('all', $village)) {
            return $geometry->get();
        }

        return $geometry->search($village);
    }

    /**
     * @param  string $type
     * @return bool
     */
    protected function hasType(string $type) : bool
    {
        return $this->request->input('type') === $type;
    }
}