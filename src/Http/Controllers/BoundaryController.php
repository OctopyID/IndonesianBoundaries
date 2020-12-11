<?php

namespace Octopy\Indonesian\Boundaries\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Octopy\Indonesian\Boundaries\Models\CityGeometry;
use Octopy\Indonesian\Boundaries\Models\ProvinceGeometry;

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
        if ($this->hasType('province')) {
            return $this->province(
                App::make(ProvinceGeometry::class)
            );
        } elseif ($this->hasType('city')) {
            return $this->city(
                App::make(CityGeometry::class)
            );
        }
    }

    /**
     * @param  ProvinceGeometry $geometry
     * @return mixed
     */
    protected function province(ProvinceGeometry $geometry)
    {
        if (is_string($province = $this->request->input('render'))) {
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
        if (is_string($city = $this->request->input('render'))) {
            $city = array_map(fn($city) => trim($city), explode(',', $city));
        }

        if (in_array('all', $city)) {
            return $geometry->get();
        }

        return $geometry->search($city);
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