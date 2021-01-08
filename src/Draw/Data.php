<?php

namespace Octopy\Indonesian\Boundaries\Draw;

use JsonSerializable;

/**
 * Class Data
 * @package Octopy\Indonesian\Boundaries\Draw
 */
final class Data implements JsonSerializable
{
    /**
     * @var int
     */
    private int $code;

    /**
     * @var array
     */
    private array $meta = [];

    /**
     * Data constructor.
     * @param  int   $code
     * @param  array $center
     */
    public function __construct(int $code, array $center = [])
    {
        $this->code = $code;
        $this->center(
            $center[0] ?? null,
            $center[1] ?? null,
        );
    }

    /**
     * @param  float|null $lat
     * @param  float|null $lng
     * @return Data
     */
    public function center(?float $lat, ?float $lng) : Data
    {
        $this->meta = compact('lat', 'lng');

        return $this;
    }

    /**
     * @return int
     */
    public function length() : int
    {
        return strlen($this->code);
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
            'code' => $this->code,
            'meta' => $this->meta,
        ];
    }
}