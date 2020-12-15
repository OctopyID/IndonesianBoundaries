<?php

namespace Octopy\Indonesian\Boundaries\Seeders;

use JsonException;
use Illuminate\Database\Seeder;
use Octopy\Indonesian\Boundaries\GeometryParser;
use Octopy\Indonesian\Boundaries\Types\GeometryFeature;
use Octopy\Indonesian\Boundaries\Models\DistrictGeometry;

class DistrictGeometrySeeder extends Seeder
{
    /**
     * @var DistrictGeometry
     */
    private DistrictGeometry $district;

    /**
     * DistrictGeometrySeeder constructor.
     * @param  DistrictGeometry $district
     */
    public function __construct(DistrictGeometry $district)
    {
        $this->district = $district;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws JsonException
     */
    public function run()
    {
        $this->district->truncate();

        $collection = GeometryParser::parse(
            __DIR__ . '/src/districts.geojson'
        );

        $collection->each(function (GeometryFeature $row) {
            try {
                if ($this->district->valid($row->property('CC_3'))) {
                    $this->district->create([
                        'geometry'    => $row->geometry(),
                        'district_id' => $row->property('CC_3'),
                    ]);
                }
            } catch (Exception $exception) {
                throw $exception;
            }
        });
    }
}