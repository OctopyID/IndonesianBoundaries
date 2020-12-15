<?php

namespace Octopy\Indonesian\Boundaries\Commands;

use Illuminate\Console\Command;
use Octopy\Indonesian\Boundaries\Seeders\DistrictGeometrySeeder;

class DistrictSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octopy:seed:district';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'District boundary seed';

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
            '--class' => DistrictGeometrySeeder::class,
        ]);

        $this->info('Seeded: District Boundaries');

        return true;
    }
}
