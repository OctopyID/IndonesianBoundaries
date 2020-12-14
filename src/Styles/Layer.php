<?php

namespace Octopy\Indonesian\Boundaries\Styles;

/**
 * @property Fill fill
 */
class Layer extends BaseStyle
{
    /**
     * @param  string $color
     * @return Layer
     * @return Layer
     */
    public function color(string $color = '#000000') : Layer
    {
        return $this->define('color', $color);
    }

    /**
     * @param  int|float $weight
     * @return Layer
     * @return Layer
     */
    public function weight($weight = 1) : Layer
    {
        return $this->define('weight', $weight);
    }

    /**
     * @param  int|float $opacity
     * @return Layer
     */
    public function opacity($opacity = 1) : Layer
    {
        return $this->define('opacity', $opacity);
    }

    /**
     * @return Fill
     */
    public function fill() : Fill
    {
        return new Fill($this);
    }

    /**
     * @return mixed|void
     */
    protected function default()
    {
        $this->color()->weight()->opacity()->fill();
    }
}