<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinceGeometriesTable extends Migration
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
        $this->table = config('laravolt.indonesia.table_prefix') . 'province_geometries';
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
            $table->char('province_id', 2);
            $table->multiPolygon('geometry');

            $table->foreign('province_id')->references('id')->on(
                config('laravolt.indonesia.table_prefix') . 'provinces'
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
