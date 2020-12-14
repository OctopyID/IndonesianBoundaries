<?php

namespace Octopy\Indonesian\Boundaries\Styles;

use Exception;
use JsonSerializable;

/**
 * @property Layer layer
 */
class Style implements JsonSerializable
{
    /**
     * @var array
     */
    private array $styles;

    /**
     * Style constructor.
     * @param  array $styles
     */
    public function __construct(array $styles)
    {
        $this->styles = $styles;
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws Exception
     */
    public function __get(string $name)
    {
        if (method_exists($this, $name)) {
            return call_user_func([$this, $name]);
        }

        throw new Exception(sprintf('Undefined property %s', $name));
    }

    /**
     * @return Layer
     */
    public function layer() : Layer
    {
        if (isset($this->styles['layer'])) {
            return $this->styles['layer'];
        }

        return $this->styles['layer'] = new Layer;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->styles;
    }
}