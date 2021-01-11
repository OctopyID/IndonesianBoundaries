<?php

namespace Octopy\Indonesian\Boundaries\Draw;

use Closure;
use JsonSerializable;
use InvalidArgumentException;
use Illuminate\Support\Collection;
use Octopy\Indonesian\Boundaries\Config\Style;
use Octopy\Indonesian\Boundaries\Config\Marker;
use Octopy\Indonesian\Boundaries\Draw\Exception\InvalidDataLengthException;

/**
 * Class DrawableMap
 * @package Octopy\Indonesian\Boundaries\Draw
 */
abstract class DrawableMap implements JsonSerializable
{
    /**
     * @var int
     */
    protected int $length = 0;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var Style
     */
    protected Style $style;

    /**
     * @var Marker
     */
    protected Marker $marker;

    /**
     * @var array
     */
    protected array $regions;

    /**
     * DrawableMap constructor.
     * @param  array               $data
     * @param  array|Closure|Style $style
     * @param  array|Closure|Style $marker
     * @throws InvalidDataLengthException
     */
    public function __construct($data = [], $style = [], $marker = [])
    {
        $this->data($data);
        $this->style($style);
        $this->marker($marker);
    }

    /**
     * @param  array|Closure|Style $style
     * @return DrawableMap
     * @return DrawableMap
     */
    public function style($style) : DrawableMap
    {
        if (! is_array($style) && ! $style instanceof Style && ! $style instanceof Closure) {
            throw new InvalidArgumentException(
                sprintf('Config must be an array or instance of Closure or %s given %s.', Style::class, gettype($style))
            );
        }

        if (is_array($style)) {
            $this->style = new Style($style);
        } else if ($style instanceof Closure) {
            $style($this->style = new Style([]));
        } else {
            $this->style = $style;
        }

        return $this;
    }

    /**
     * @param  array|Closure|Marker $marker
     * @return DrawableMap
     * @return DrawableMap
     */
    public function marker($marker) : DrawableMap
    {
        if (! is_array($marker) && ! $marker instanceof Marker && ! $marker instanceof Closure) {
            throw new InvalidArgumentException(
                sprintf('Config must be an array or instance of Closure or %s given %s.', Marker::class, gettype($marker))
            );
        }

        if (is_array($marker)) {
            $this->marker = new Marker($marker);
        } else if ($marker instanceof Closure) {
            $marker($this->marker = new Marker([]));
        } else {
            $this->marker = $marker;
        }

        return $this;
    }

    /**
     * @param  array|Collection $data
     * @throws InvalidDataLengthException
     */
    public function data($data)
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        if (! is_array($data)) {
            $data = [$data];
        }

        $this->regions = array_map(function ($data) {

            if (! $data instanceof Data) {
                $data = new Data($data);
            }

            if (! $data->hasValidLength($this)) {
                throw new InvalidDataLengthException(
                    sprintf('The maximum length of each region data set is %d given %s', $this->length, $data->length())
                );
            }

            return $data;
        }, array_values(array_unique($data)));
    }

    /**
     * @return string
     */
    abstract public function name() : string;

    /**
     * @return int
     */
    public function length() : int
    {
        return $this->length;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return [
            'style' => $this->style,
            'marker' => $this->marker,
            'regions' => $this->regions,
        ];
    }
}