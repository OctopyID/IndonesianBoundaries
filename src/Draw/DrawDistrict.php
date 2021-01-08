<?php

namespace Octopy\Indonesian\Boundaries\Draw;

/**
 * Class DrawDistrict
 * @package Octopy\Indonesian\Boundaries\Draw
 */
class DrawDistrict extends DrawableMap
{
    /**
     * @var int
     */
    protected int $length = 7;

    /**
     * @return string
     */
    public function name() : string
    {
        return 'districts';
    }
}