<?php

namespace Octopy\Indonesian\Boundaries\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;
use Octopy\Indonesian\Boundaries\Models\CityGeometry;

class CityGeometrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        CityGeometry::truncate();

        $sources = collect(
            json_decode(file_get_contents(__DIR__ . '/src/cities.json'))
        );

        $sources->each(function ($cities) {
            foreach ($cities as $city => $row) {
                $polygons = [];
                foreach ($row->coor as $coor) {
                    $points = [];
                    foreach ($coor as $coordinates) {
                        foreach ($coordinates as $point) {
                            $points[] = new Point($point[1], $point[0]);
                        }
                    }

                    $polygons[] = new Polygon([
                        new LineString($points),
                    ]);
                }

                try {
                    CityGeometry::create([
                        'city_id' => $row->code,
                        'geometry' => new MultiPolygon($polygons),
                    ]);
                } catch (Exception $exception) {
                    //
                }
            }
        });
    }
}
