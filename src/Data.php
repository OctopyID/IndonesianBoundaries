<?php

namespace Octopy\Indonesian\Boundaries;

use JsonSerializable;
use Octopy\Indonesian\Boundaries\Draw\DrawableMap;

final class Data implements JsonSerializable
{
    /**
     * @var int
     */
    private int $region;

    /**
     * @var array
     */
    private array $center = [];

    /**
     * Data constructor.
     * @param  int   $region
     * @param  array $center
     */
    public function __construct(int $region, array $center = [])
    {
        $this->region = $region;
        $this->center(
            $center[0] ?? null,
            $center[1] ?? null,
        );
    }

    /**
     * @param  float|null $lat
     * @param  float|null $lng
     */
    public function center(?float $lat, ?float $lng)
    {
        $this->center = compact('lat', 'lng');
    }

    /**
     * @return int
     */
    public function length() : int
    {
        return strlen($this->region);
    }

    /**
     * @param  DrawableMap $drawable
     * @return bool
     */
    public function hasValidLength(DrawableMap $drawable) : bool
    {
        return $this->length() === $drawable->length();
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return [
            'region' => $this->region,
            'center' => $this->center,
        ];
    }
}