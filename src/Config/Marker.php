<?php

namespace Octopy\Indonesian\Boundaries\Config;

use Octopy\Indonesian\Boundaries\Collection;

/**
 * Class Marker
 * @package Octopy\Indonesian\Boundaries\Config
 */
class Marker extends Collection
{
    /**
     * Marker constructor.
     * @param  array $marker
     */
    public function __construct(array $marker = [])
    {
        $this->merge(array_merge_recursive(
            config('boundary.marker'), $marker
        ));
    }
    
    /**
     * @param  array $options
     * @return Marker
     */
    public function options(array $options) : Marker
    {
        foreach ($options as $name => $value) {
            $this->set('options.' . $name, $value);
        }
        
        return $this;
    }
    
    /**
     * @param  float $opacity
     * @return Marker
     */
    public function opacity(float $opacity) : Marker
    {
        return $this->set('options.opacity', $opacity);
    }
    
    /**
     * @param  bool $draggable
     * @return Marker
     */
    public function draggable(bool $draggable) : Marker
    {
        return $this->set('options.draggable', $draggable);
    }
    
    /**
     * @param  bool $rise
     * @return Marker
     */
    public function riseOnHover(bool $rise = false) : Marker
    {
        return $this->set('options.riseOnHover', $rise);
    }
    
    /**
     * @param  bool $autopan
     * @return Marker
     */
    public function autoPan(bool $autopan = false) : Marker
    {
        return $this->set('options.autoPan', $autopan);
    }
    
    /**
     * @param  array $options
     * @return $this
     */
    public function icon(array $options) : Marker
    {
        foreach ($options as $name => $value) {
            $this->set('icon.' . $name, $value);
        }
        
        return $this;
    }
    
    /**
     * @param  string $theme
     * @return Marker
     */
    public function iconURL(string $theme = 'default.red.png') : Marker
    {
        return $this->set('icon.iconUrl', $theme);
    }
    
    /**
     * @param  string $theme
     * @return $this
     */
    public function iconTheme(string $theme) : Marker
    {
        return $this->iconURL($theme);
    }
    
    /**
     * @param  int $width
     * @param  int $height
     * @return Marker
     */
    public function iconSize(int $width, int $height) : Marker
    {
        return $this->set('icon.iconSize', [$width, $height]);
    }
    
    /**
     * @param  int $offsetX
     * @param  int $offsetY
     * @return Marker
     */
    public function iconAnchor(int $offsetX, int $offsetY) : Marker
    {
        return $this->set('icon.iconAnchor', [$offsetX, $offsetY]);
    }
    
    /**
     * @param  string $theme
     * @return Marker
     */
    public function shadowIcon(string $theme = 'default.red.png') : Marker
    {
        return $this->set('icon.shadowUrl', $theme);
    }
    
    /**
     * @param  int $width
     * @param  int $height
     * @return Marker
     */
    public function shadowSize(int $width, int $height) : Marker
    {
        return $this->set('icon.shadowSize', [$width, $height]);
    }
    
    /**
     * @param  int $offsetX
     * @param  int $offsetY
     * @return Marker
     */
    public function shadowAnchor(int $offsetX, int $offsetY) : Marker
    {
        return $this->set('icon.shadowAnchor', [$offsetX, $offsetY]);
    }
    
    /**
     * @param  int $offsetX
     * @param  int $offsetY
     * @return Marker
     */
    public function popupAnchor(int $offsetX, int $offsetY) : Marker
    {
        return $this->set('icon.popupAnchor', [$offsetX, $offsetY]);
    }
}