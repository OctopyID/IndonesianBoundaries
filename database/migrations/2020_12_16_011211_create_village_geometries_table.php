<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageGeometriesTable extends Migration
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
        $this->table = config('laravolt.indonesia.table_prefix') . 'village_geometries';
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
            $table->char('village_id', 10);
            $table->multiPolygon('geometry');

            $table->foreign('village_id')->references('id')->on(
                config('laravolt.indonesia.table_prefix') . 'villages'
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
