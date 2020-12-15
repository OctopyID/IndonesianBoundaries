<?php

namespace Octopy\Indonesian\Boundaries\Draw;

use JsonSerializable;

class Draw implements JsonSerializable
{
    /**
     * @var array
     */
    protected array $drawable = [];

    /**
     * @param  array $data
     * @param  array $conf
     * @return DrawProvince
     * @throws Exception\InvalidDataLengthException
     */
    public function province(array $data = [], $conf = []) : DrawProvince
    {
        return $this->drawable[] = new DrawProvince($data, $conf);
    }

    /**
     * @param  array $data
     * @param  array $conf
     * @return DrawCity
     * @throws Exception\InvalidDataLengthException
     */
    public function city(array $data = [], $conf = []) : DrawCity
    {
        return $this->drawable[] = new DrawCity($data, $conf);
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        $data = [];

        foreach ($this->drawable as $drawable) {
            $data[$drawable->name()] = $drawable;
        }

        return $data;
    }
}