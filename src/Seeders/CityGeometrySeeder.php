<?php

namespace Octopy\Indonesian\Boundaries\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Octopy\Indonesian\Boundaries\Models\CityGeometry;
use Octopy\Indonesian\Boundaries\Types\GeometryFeature;
use Octopy\Indonesian\Boundaries\GeometryParser;

class CityGeometrySeeder extends Seeder
{
    /**
     * @var CityGeometry
     */
    private CityGeometry $city;

    /**
     * CityGeometrySeeder constructor.
     * @param  CityGeometry $city
     */
    public function __construct(CityGeometry $city)
    {
        $this->city = $city;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $this->city->truncate();

        $collection = GeometryParser::parse(
            __DIR__ . '/src/cities.geojson'
        );

        $collection->each(function (GeometryFeature $row) {
            try {
                if ($this->city->valid($row->property('CC_2'))) {
                    $this->city->create([
                        'geometry' => $row->geometry(),
                        'city_id'  => $row->property('CC_2'),
                    ]);
                }
            } catch (Exception $exception) {
                throw $exception;
            }
        });
    }
}
