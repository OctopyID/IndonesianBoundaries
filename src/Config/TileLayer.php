<?php

namespace Octopy\Indonesian\Boundaries\Config;

use Octopy\Indonesian\Boundaries\Collection;

/**
 * Class TileLayer
 * @package Octopy\Indonesian\Boundaries\Config
 */
class TileLayer extends Collection
{
    /**
     * TileLayer constructor.
     * @param  array $tiles
     */
    public function __construct(array $tiles = [])
    {
        $this->merge(array_merge_recursive(
            config('boundary.basemap.tilelayer', []), $tiles
        ));
    }
    
    /**
     * @param  bool $label
     * @return TileLayer
     */
    public function label(bool $label = true) : TileLayer
    {
        return $this->set('label', $label);
    }
    
    /**
     * @param  string $theme
     * @return TileLayer
     */
    public function theme(string $theme) : TileLayer
    {
        return $this->set('theme', $theme);
    }
    
    /**
     * @param  int $min
     * @return TileLayer
     */
    public function minZoom(int $min) : TileLayer
    {
        return $this->set('options.minZoom', $min);
    }
    
    /**
     * @param  int $max
     * @return TileLayer
     */
    public function maxZoom(int $max) : TileLayer
    {
        return $this->set('options.maxZoom', $max);
    }
    
    /**
     * @param  int $offset
     * @return TileLayer
     */
    public function zoomOffset(int $offset) : TileLayer
    {
        return $this->set('options.zoomOffset', $offset);
    }
    
    /**
     * @param  bool $reverse
     * @return TileLayer
     */
    public function zoomReverse(bool $reverse) : TileLayer
    {
        return $this->set('options.zoomReverse', $reverse);
    }
    
    /**
     * @param  bool $retina
     * @return TileLayer
     */
    public function detectRetina(bool $retina) : TileLayer
    {
        return $this->set('options.detectRetina', $retina);
    }
    
    /**
     * @param  bool $cors
     * @return TileLayer
     */
    public function crossOrigin(bool $cors) : TileLayer
    {
        return $this->set('options.crossOrigin', $cors);
    }
}