<?php

namespace Octopy\Indonesian\Boundaries\Types;

use GeoJson\Feature\Feature;
use Illuminate\Support\Collection;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use GeoJson\Geometry\Polygon as GeoJSONPolygon;
use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;
use GeoJson\Geometry\MultiPolygon as GeoJSONMultiPolygon;

class GeometryFeature
{
    /**
     * @var Feature
     */
    private Feature $feature;

    /**
     * Geometry constructor.
     * @param $feature
     */
    public function __construct(Feature $feature)
    {
        $this->feature = $feature;
    }

    /**
     * @return Collection
     */
    public function properties() : Collection
    {
        return new Collection($this->feature->getProperties());
    }

    /**
     * @param  string $name
     * @param  null   $default
     * @return mixed
     */
    public function property(string $name, $default = null)
    {
        return $this->properties()->get($name, $default);
    }

    /**
     * @return MultiPolygon
     */
    public function geometry() : MultiPolygon
    {
        $geometry = $this->feature->getGeometry();

        if ($geometry instanceof GeoJSONMultiPolygon) {
            return MultiPolygon::fromJson($this->feature->getGeometry());
        } else if ($geometry instanceof GeoJSONPolygon) {
            return new MultiPolygon([
                Polygon::fromJson($geometry),
            ]);
        }
    }
}