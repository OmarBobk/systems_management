<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
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
        $username  = env('DB_USERNAME');
        $password  = env('DB_PASSWORD');
        $host      = env('DB_HOST');
        $db_name   = env('DB_DATABASE');
        $file_path = storage_path()."/database_backups/$file_name";
        $command   = 'mysqldump --user="'.$username.'" --password='.$password.' --host="'.$host.'" "'.$db_name.'" > ' . $file_path;

        exec($command);

        $client    = new Client();

        $url       = 'https://discord.com/api/webhooks/1057327329581482005/xdNpgrtaAOR4XmWWUT7V91gTK6PsPIaMpYjCmKGF8h6aIWBpxauWzh7FAcTDUE7y1fqU';

        $response = $client->post($url, [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => file_get_contents($file_path),
                    'filename' => $file_name,
                ]
            ],
        ]);
    }
}
