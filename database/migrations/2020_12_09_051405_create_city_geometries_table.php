<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityGeometriesTable extends Migration
{
    /**
     * @var string
     */
    private string $table;

    /**
     * CreateProvinceBordersTable constructor.
     */
    public function __construct()
    {
        $this->table = config('laravolt.indonesia.table_prefix') . 'city_geometries';
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
            $table->char('city_id', 4);
            $table->multiPolygon('geometry')->nullable();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on(
                config('laravolt.indonesia.table_prefix') . 'cities'
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
