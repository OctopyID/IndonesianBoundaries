<?php

namespace Octopy\Indonesian\Boundaries\Styles;

final class Fill extends BaseStyle
{
    /**
     * @var Layer
     */
    private Layer $layer;

    /**
     * Fill constructor.
     * @param  Layer $layer
     */
    public function __construct(Layer $layer)
    {
        $this->layer = $layer;
        parent::__construct();
    }

    /**
     * @param  string $color
     * @return Fill
     */
    public function color(string $color) : Fill
    {
        $this->layer->define('fillColor', $color);

        return $this;
    }

    /**
     * @param  int|float $opacity
     * @return Fill
     */
    public function opacity($opacity = 0.2) : Fill
    {
        $this->layer->define('fillOpacity', $opacity);

        return $this;
    }

    /**
     * @return mixed|void
     */
    protected function default()
    {
        $this->color('#FF0000')->opacity();
    }
}