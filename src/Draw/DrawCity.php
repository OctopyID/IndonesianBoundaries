<?php

namespace Octopy\Indonesian\Boundaries\Draw;

class DrawCity extends DrawableMap
{
    /**
     * @var int
     */
    protected int $length = 4;

    /**
     * @return string
     */
    public function name() : string
    {
        return 'city';
    }
}