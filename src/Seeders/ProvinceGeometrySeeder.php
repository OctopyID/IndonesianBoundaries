<?php

namespace Octopy\Indonesian\Boundaries\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Octopy\Indonesian\Boundaries\GeometryParser;
use Octopy\Indonesian\Boundaries\Types\GeometryFeature;
use Octopy\Indonesian\Boundaries\Models\ProvinceGeometry;

class ProvinceGeometrySeeder extends Seeder
{
    /**
     * @var ProvinceGeometry
     */
    private ProvinceGeometry $province;

    /**
     * ProvinceGeometrySeeder constructor.
     * @param  ProvinceGeometry $province
     */
    public function __construct(ProvinceGeometry $province)
    {
        $this->province = $province;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $this->province->truncate();

        $collection = GeometryParser::parse(
            __DIR__ . '/src/provinces.geojson'
        );

        $collection->each(function (GeometryFeature $row) {
            try {
                if ($this->province->valid($row->property('CC_1'))) {
                    $this->province->create([
                        'geometry'    => $row->geometry(),
                        'province_id' => $row->property('CC_1'),
                    ]);
                }
            } catch (Exception $exception) {
                throw $exception;
            }
        });
    }
}
