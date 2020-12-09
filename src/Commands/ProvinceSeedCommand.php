<?php

namespace Octopy\Indonesian\Boundaries\Commands;

use Illuminate\Console\Command;
use Octopy\Indonesian\Boundaries\Seeders\ProvinceGeometrySeeder;

class ProvinceSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octopy:seed:province';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provincial boundary seed';

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
            '--class' => ProvinceGeometrySeeder::class,
        ]);

        $this->info('Seeded: Province Boundaries');

        return true;
    }
}
