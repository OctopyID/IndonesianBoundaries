<?php

namespace Octopy\Indonesian\Boundaries\Styles;

use Exception;
use JsonSerializable;

abstract class BaseStyle implements JsonSerializable
{
    /**
     * @var array
     */
    protected array $style = [];

    /**
     * BaseStyle constructor.
     */
    public function __construct()
    {
        $this->default();
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
     * @param  string $key
     * @param  mixed  $value
     * @return BaseStyle
     */
    public function define(string $key, $value) : BaseStyle
    {
        $this->style = array_merge($this->style, [
            $key => $value,
        ]);

        if ($value instanceof $this) {
            return $value;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    abstract protected function default();

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->style;
    }
}