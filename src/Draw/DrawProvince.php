<?php

namespace Octopy\Indonesian\Boundaries\Draw;

class DrawProvince extends DrawableMap
{
    /**
     * @var int
     */
    protected int $length = 2;

    /**
     * @return string
     */
    public function name() : string
    {
        return 'prov';
    }
}