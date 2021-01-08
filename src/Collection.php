<?php

namespace Octopy\Indonesian\Boundaries;

use JsonSerializable;
use Illuminate\Support\Arr;

/**
 * Class Collection
 * @package Octopy\Indonesian\Boundaries
 */
abstract class Collection implements JsonSerializable
{
    /**
     * @var array
     */
    protected array $values = [];

    /**
     * @param  string $key
     * @param  mixed  $value
     * @return Collection
     */
    public function set(string $key, $value) : Collection
    {
        Arr::set($this->values, $key, $value);

        return $this;
    }

    /**
     * @param  array $array
     */
    public function merge(array $array)
    {
        $this->values = array_merge_recursive($this->values, $array);
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->values;
    }
}