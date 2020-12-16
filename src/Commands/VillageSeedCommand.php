<?php

namespace Octopy\Indonesian\Boundaries\Commands;

use Illuminate\Console\Command;
use Octopy\Indonesian\Boundaries\Seeders\VillageGeometrySeeder;

class VillageSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octopy:seed:village';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Village boundary seed';

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
            '--class' => VillageGeometrySeeder::class,
        ]);

        $this->info('Seeded: Village Boundaries');

        return true;
    }
}
