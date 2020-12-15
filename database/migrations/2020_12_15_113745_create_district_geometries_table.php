<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictGeometriesTable extends Migration
{
    /**
     * @var string
     */
    private string $table;

    /**
     * CreateDistrictGeometriesTable constructor.
     */
    public function __construct()
    {
        $this->table = config('laravolt.indonesia.table_prefix') . 'district_geometries';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->char('district_id', 7);
            $table->multiPolygon('geometry');

            $table->foreign('district_id')->references('id')->on(
                config('laravolt.indonesia.table_prefix') . 'districts'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
