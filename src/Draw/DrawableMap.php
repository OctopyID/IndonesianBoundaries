<?php

namespace Octopy\Indonesian\Boundaries\Draw;

use Closure;
use JsonSerializable;
use InvalidArgumentException;
use Octopy\Indonesian\Boundaries\Data;
use Octopy\Indonesian\Boundaries\Styles\Style;
use Octopy\Indonesian\Boundaries\Draw\Exception\InvalidDataLengthException;

abstract class DrawableMap implements JsonSerializable
{
    /**
     * @var int
     */
    protected int $length = 0;

    /**
     * @var array
     */
    protected array $data;

    /**
     * @var Style
     */
    protected Style $conf;

    /**
     * @var string
     */
    protected string $type;

    /**
     * DrawableMap constructor.
     * @param  array $data
     * @param  array $conf
     * @throws InvalidDataLengthException
     */
    public function __construct(array $data = [], $conf = [])
    {
        $this->data($data);
        $this->conf(array_merge([
            'layer' => config('boundary.layer', []),
        ], $conf));
    }

    /**
     * @param $style
     */
    public function style($style)
    {
        $this->conf($style);
    }

    /**
     * @param  mixed $conf
     */
    public function conf($conf)
    {
        if (! is_array($conf) && ! $conf instanceof Style && ! $conf instanceof Closure) {
            throw new InvalidArgumentException(
                sprintf('Config must be an array or instance of Closure or %s given %s.', Style::class, gettype($conf))
            );
        }

        if (is_array($conf)) {
            $this->conf = new Style($conf);
        } else if ($conf instanceof Closure) {
            $conf($this->conf = new Style([]));
        } else {
            $this->conf = $conf;
        }
    }

    /**
     * @param  array $data
     * @throws InvalidDataLengthException
     */
    public function data(array $data)
    {
        $this->data = array_map(function ($data) {

            if (! $data instanceof Data) {
                $data = new Data($data);
            }

            if (! $data->hasValidLength($this)) {
                throw new InvalidDataLengthException(
                    sprintf('The maximum length of each city data set is %d given %s', $this->length, $data->length())
                );
            }

            return $data;
        }, array_unique($data));
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
            'conf' => $this->conf,
            'data' => $this->data,
        ];
    }
}