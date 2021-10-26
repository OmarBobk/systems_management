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
            'amount'            => 10000,
            'description'       => "This is the description",
            'deposit_date'      => Carbon::create("2021", "10", "13"),
            'due_date'          => Carbon::create("2022", "10", "13"),
            'profits_percent'   => 100,
            'contributor_id'    => 1,
        ];

        // Yusuf Karman
        $contributions[] = [
            'amount'            => 5000,
            'description'       => "This is the description",
            'deposit_date'      => Carbon::create("2021", "10", "13"),
            'due_date'          => Carbon::create("2022", "10", "13"),
            'profits_percent'   => 40,
            'contributor_id'    => 2,
        ];

        Contribution::insert($contributions);
    }
}
