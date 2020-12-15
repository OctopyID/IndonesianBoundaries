<?php

namespace Octopy\Indonesian\Boundaries;

use JsonException;
use GeoJson\GeoJson;
use GeoJson\Feature\FeatureCollection;
use Octopy\Indonesian\Boundaries\Types\GeometryFeature;
use Octopy\Indonesian\Boundaries\Types\GeometryFeatureCollection;
use Grimzy\LaravelMysqlSpatial\Exceptions\InvalidGeoJsonException;

class GeometryParser
{
    /**
     * @param  string $json
     * @return GeometryFeatureCollection
     * @throws JsonException
     */
    public static function parse(string $json) : GeometryFeatureCollection
    {
        try {
            $json = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            try {
                $json = json_decode(file_get_contents($json), false, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $exception) {
                throw $exception;
            }
        }

        $geoJSON = GeoJson::jsonUnserialize($json);

        if (! $geoJSON instanceof FeatureCollection) {
            throw new InvalidGeoJsonException(
                sprintf("Expected %s, got%s", FeatureCollection::class, get_class($geoJSON))
            );
        }

        $geometry = [];
        foreach ($geoJSON->getFeatures() as $feature) {
            $geometry[] = new GeometryFeature($feature);
        }

        return new GeometryFeatureCollection($geometry);
    }
}