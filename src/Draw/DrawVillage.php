<?php

namespace Octopy\Indonesian\Boundaries\Draw;

class DrawVillage extends DrawableMap
{
    /**
     * @var int
     */
    protected int $length = 10;

    /**
     * @return string
     */
    public function name() : string
    {
        return 'vill';
    }
}