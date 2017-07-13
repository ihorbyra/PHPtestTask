<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Message;

class DestroyAfterHourCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destroy:after-hour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy message after 1 hour';

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
     * @return mixed
     */
    public function handle()
    {
        return Message::where([
            ['created_at', '<', DB::raw('(NOW() - INTERVAL 60 MINUTE)')],
            ['destruction', '=', 2],
        ])->delete();
    }
}
