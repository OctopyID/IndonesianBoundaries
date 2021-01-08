<?php

namespace Octopy\Indonesian\Boundaries;

use Closure;
use Exception;
use JsonSerializable;
use Octopy\Indonesian\Boundaries\Draw\Draw;
use Octopy\Indonesian\Boundaries\Config\TileLayer;

/**
 * Class BaseMap
 * @package Octopy\Indonesian\Boundaries
 */
class BaseMap extends Collection implements JsonSerializable
{
    /**
     * BaseMap constructor
     */
    public function __construct()
    {
        $this->merge(array_merge(config('boundary.basemap'), [
            'data' => [],
        ]));
    }

    /**
     * @param  null $drawable
     * @return BaseMap
     * @throws Exception
     */
    public function draw($drawable = null) : BaseMap
    {
        $draw = new Draw;
        if ($drawable instanceof Closure) {
            $drawable($draw);
        }

        return $this->set('data', $draw);
    }

    /**
     * @param  float $lat
     * @param  float $lng
     * @return BaseMap
     */
    public function center(float $lat, float $lng) : BaseMap
    {
        return $this->set('options.center', compact('lat', 'lng'));
    }

    /**
     * @param  array $options
     * @return BaseMap
     */
    public function options(array $options) : BaseMap
    {
        return $this->set('options', $options);
    }

    /**
     * @param  Closure|TileLayer $tilelayer
     * @return BaseMap
     */
    public function tileLayer($tilelayer) : BaseMap
    {
        if ($tilelayer instanceof Closure) {
            $tilelayer($tilelayer = new TileLayer());
        }

        return $this->set('tilelayer', $tilelayer);
    }
}