<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

/**
 * @property array properties
 *
 * @method get()
 * @method truncate()
 * @method search(array|mixed|string[] $city)
 * @method create(array $array)
 */
abstract class Model extends Eloquent
{
    use SpatialTrait;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $appends = [
        'properties',
    ];

    /**
     * @var string[]
     */
    protected $spatialFields = [
        'geometry',
    ];

    /**
     * Model constructor.
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravolt.indonesia.table_prefix') . $this->table;
    }

    /**
     * @return array
     */
    public abstract function getPropertiesAttribute() : array;

    /**
     * @param  int $code
     * @return bool
     */
    public abstract function valid(int $code) : bool;

    /**
     * @param  Builder $builder
     * @param  array   $search
     * @return mixed
     */
    public abstract function scopeSearch(Builder $builder, array $search);
}