<?php

namespace Octopy\Indonesian\Boundaries\Seeders;

use JsonException;
use Illuminate\Database\Seeder;
use Octopy\Indonesian\Boundaries\GeometryParser;
use Octopy\Indonesian\Boundaries\Types\GeometryFeature;
use Octopy\Indonesian\Boundaries\Models\VillageGeometry;

class VillageGeometrySeeder extends Seeder
{
    /**
     * @var VillageGeometry
     */
    private VillageGeometry $district;

    /**
     * VillageGeometrySeeder constructor.
     * @param  VillageGeometry $district
     */
    public function __construct(VillageGeometry $district)
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
            __DIR__ . '/src/villages.geojson'
        );

        $collection->each(function (GeometryFeature $row) {
            try {
                if ($this->district->valid($row->property('CC_4'))) {
                    $this->district->create([
                        'geometry'   => $row->geometry(),
                        'village_id' => $row->property('CC_4'),
                    ]);
                }
            } catch (Exception $exception) {
                throw $exception;
            }
        });
    }
}