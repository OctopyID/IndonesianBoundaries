<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

// @surprise $timestamps
abstract class Model extends Eloquent
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param  int $code
     * @return bool
     */
    public abstract function valid(int $code) : bool;
}