<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Contributor;
use Carbon\Carbon;
use Exception;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $contributions = [];

        // Ahmad Omar Karman
        $contributions[] = [
            'amount'            => 1000000,
            'description'       => "This is the description",
            'deposit_date'      => Carbon::create("2021", "10", "13"),
            'due_date'          => Carbon::create("2022", "10", "13"),
            'profits_percent'   => 100,
            'contributor_id'    => 1,
            'status'            => 0,
            'created_at'        => '2021-10-13 00:00:00',
            'updated_at'        => '2021-10-13 00:00:00',
        ];

        // Yusuf Karman
        $contributions[] = [
            'amount'            => 5000000,
            'description'       => "This is the description",
            'deposit_date'      => Carbon::create("2021", "10", "13"),
            'due_date'          => Carbon::create("2022", "10", "13"),
            'profits_percent'   => 20,
            'contributor_id'    => 2,
            'status'            => 0,
            'created_at'        => '2021-10-13 00:00:00',
            'updated_at'        => '2021-10-13 00:00:00',
        ];

        Contribution::insert($contributions);
    }
}
