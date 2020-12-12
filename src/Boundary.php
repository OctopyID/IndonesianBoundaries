<?php

namespace Octopy\Indonesian\Boundaries;

use Closure;
use Illuminate\Support\Facades\App;

class Boundary
{
    /**
     * @var mixed
     */
    private BoundaryConfig $config;

    /**
     * Boundary constructor.
     */
    public function __construct()
    {
        $this->config = App::make(BoundaryConfig::class);
    }

    /**
     * @param  Closure|null $closure
     * @return mixed
     */
    public function config(Closure $closure = null)
    {
        $config = App::make(BoundaryConfig::class);

        if (is_null($closure)) {
            return $config;
        }

        return $closure($config);
    }

    /**
     * @param  mixed ...$province
     */
    public function renderProvince(...$province)
    {
        $this->config->search([
            'province' => is_array($province[0]) ? $province[0] : $province,
        ]);
    }

    /**
     * @param  mixed ...$city
     */
    public function renderCity(...$city)
    {
        $this->config->search([
            'city' => is_array($city[0]) ? $city[0] : $city,
        ]);
    }
}