<?php

namespace Octopy\Indonesian\Boundaries\Config;

use Octopy\Indonesian\Boundaries\Collection;

/**
 * Class Style
 * @package Octopy\Indonesian\Boundaries\Config
 */
class Style extends Collection
{
    /**
     * Style constructor.
     * @param  array $styles
     */
    public function __construct(array $styles = [])
    {
        $this->merge(array_merge_recursive(
            config('boundary.styles'), $styles
        ));
    }

    /**
     * @param  bool $stroke
     * @return Style
     */
    public function stroke(bool $stroke = true) : Style
    {
        return $this->set('stroke', $stroke);
    }

    /**
     * @param  string $color
     * @return Style
     */
    public function color(string $color = '#000000') : Style
    {
        return $this->set('color', $color);
    }

    /**
     * @param  int|float $weight
     * @return Style
     */
    public function weight($weight = 1) : Style
    {
        return $this->set('weight', $weight);
    }

    /**
     * @param  int|float $opacity
     * @return Style
     */
    public function opacity($opacity = 1) : Style
    {
        return $this->set('opacity', $opacity);
    }

    /**
     * @param  bool $fill
     * @return Style
     */
    public function fill(bool $fill = true) : Style
    {
        return $this->set('fill', $fill);
    }

    /**
     * @param  string $color
     * @return Style
     */
    public function fillColor(string $color) : Style
    {
        return $this->set('fillColor', $color);
    }

    /**
     * @param  int|float $opacity
     * @return Style
     */
    public function fillOpacity($opacity = 0.5) : Style
    {
        return $this->set('fillOpacity', $opacity);
    }

    /**
     * @param  string $rule
     * @return Style
     */
    public function fillRule(string $rule = 'odd') : Style
    {
        return $this->set('fillRule', $rule);
    }

    /**
     * @param  string $cap
     * @return Style
     */
    public function lineCap(string $cap = 'round') : Style
    {
        return $this->set('lineCap', $cap);
    }

    /**
     * @param  string $join
     * @return Style
     */
    public function lineJoin(string $join = 'round') : Style
    {
        return $this->set('lineJoin', $join);
    }
}