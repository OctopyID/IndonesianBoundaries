<?php

namespace Octopy\Indonesian\Boundaries;

use Exception;
use JsonSerializable;

/**
 * Class Boundary
 * @package Octopy\Indonesian\Boundaries
 */
class Boundary implements JsonSerializable
{
    /**
     * @var array
     */
    private array $container = [];

    /**
     * @param  string $element
     * @return BaseMap
     * @throws Exception
     */
    public function element(string $element) : BaseMap
    {
        if (! is_string($element)) {
            $element = config('boundary.element', 'map');
        }

        if (isset($this->container[$element])) {
            throw new Exception($element . ' elements already defined.');
        }

        return $this->container[$element] = new BaseMap;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->container;
    }
}