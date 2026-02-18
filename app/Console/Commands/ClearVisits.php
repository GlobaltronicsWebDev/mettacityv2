<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all visit tracking data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->confirm('Are you sure you want to clear all visit data?')) {
            DB::table('visits')->truncate();
            $this->info('All visit data has been cleared successfully!');
            $this->info('Visit counts are now reset to 0.');
        } else {
            $this->info('Operation cancelled.');
        }

        return 0;
    }
}
