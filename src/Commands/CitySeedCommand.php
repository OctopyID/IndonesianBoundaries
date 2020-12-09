<?php

namespace Octopy\Indonesian\Boundaries\Commands;

use Illuminate\Console\Command;
use Octopy\Indonesian\Boundaries\Seeders\CityGeometrySeeder;

class CitySeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octopy:seed:city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'City boundary seed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : int
    {
        $this->call('db:seed', [
            '--class' => CityGeometrySeeder::class,
        ]);

        $this->info('Seeded: City Boundaries');

        return true;
    }
}
