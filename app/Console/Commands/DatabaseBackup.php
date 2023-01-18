<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database with all its records.';

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
     */
    public function handle()
    {

        $file_name = Carbon::now()->format('Y-m-d_H-i-s').'.sql';

        $command   = 'mysqldump --user="root" --password="" --host="'.env('APP_URL').'" "'.env('DB_DATABASE').'" > ' . storage_path()."/database_backups/$file_name";

        exec($command);
    }
}
