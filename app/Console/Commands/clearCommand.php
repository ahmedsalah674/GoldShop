<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
class clearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:projectCache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This custom Command can Be refresh the project';

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
    public function handle()
    {
        $config=Artisan::call('config:cache');
        $cache=Artisan::call('cache:clear');
        $view=Artisan::call('view:clear');
        return ($config && $cache && $view);
    }
}
