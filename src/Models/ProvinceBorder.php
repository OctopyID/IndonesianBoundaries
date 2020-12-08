<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class ProvinceBorder extends Model
{
    use SpatialTrait;

    /**
     * @var string
     */
    protected $table = 'province_borders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'province_id', 'geometry',
    ];

    /**
     * @var string[]
     */
    protected $spatialFields = [
        'geometry',
    ];

    /**
     * ProvinceBorder constructor.
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravolt.indonesia.table_prefix') . $this->table;
    }

    /**
     * @return BelongsTo
     */
    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}