<?php

namespace Octopy\Indonesian\Boundaries;

use Closure;
use Exception;
use JsonSerializable;
use Octopy\Indonesian\Boundaries\Draw\Draw;

class BaseMap implements JsonSerializable
{
    /**
     * @var array
     */
    private array $basemap;

    /**
     * BaseMap constructor
     */
    public function __construct()
    {
        $this->basemap = array_merge(config('boundary.basemap'), [
            'data' => [],
        ]);
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

        $this->basemap['data'] = $draw;

        return $this;
    }

    /**
     * @param  float $lat
     * @param  float $lng
     * @return BaseMap
     */
    public function center(float $lat, float $lng) : BaseMap
    {
        $this->basemap['center'] = compact('lat', 'lng');

        return $this;
    }

    /**
     * @param  string $theme
     * @param  bool   $label
     * @return BaseMap
     */
    public function theme(string $theme, bool $label = true) : BaseMap
    {
        $this->basemap['background'] = compact('theme', 'label');

        return $this;
    }

    /**
     * @param  array $options
     * @return BaseMap
     */
    public function options(array $options) : BaseMap
    {
        $this->basemap['options'] = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->basemap;
    }
}