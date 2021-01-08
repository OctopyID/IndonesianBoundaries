<?php

namespace Octopy\Indonesian\Boundaries\Draw;

/**
 * Class DrawVillage
 * @package Octopy\Indonesian\Boundaries\Draw
 */
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
        return 'villages';
    }
}