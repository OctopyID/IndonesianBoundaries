<?php

namespace Octopy\Indonesian\Boundaries\Draw;

use JsonSerializable;

/**
 * Class Draw
 * @package Octopy\Indonesian\Boundaries\Draw
 */
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
    public function province($data = [], $conf = []) : DrawProvince
    {
        return $this->drawable[] = new DrawProvince($data, $conf);
    }

    /**
     * @param  array $data
     * @param  array $conf
     * @return DrawCity
     * @throws Exception\InvalidDataLengthException
     */
    public function city($data = [], $conf = []) : DrawCity
    {
        return $this->drawable[] = new DrawCity($data, $conf);
    }

    /**
     * @param  array $data
     * @param  array $conf
     * @return DrawDistrict
     * @throws Exception\InvalidDataLengthException
     */
    public function district($data = [], $conf = []) : DrawDistrict
    {
        return $this->drawable[] = new DrawDistrict($data, $conf);
    }

    /**
     * @param  array $data
     * @param  array $conf
     * @return DrawVillage
     * @throws Exception\InvalidDataLengthException
     */
    public function village($data = [], $conf = []) : DrawVillage
    {
        return $this->drawable[] = new DrawVillage($data, $conf);
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