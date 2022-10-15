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

        // Owner
        $contributions[] = [
            'amount'            => 100000000,
            'description'       => "This one is for stocktaking so first will create bill.products and get the total cost and then edit this contribution amount and then edit the bill amount and then create the products in the database",
            'deposit_date'      => Carbon::create("2021", "10", "13"),
            'due_date'          => Carbon::create("2022", "10", "13"),
            'profits_percent'   => 100,
            'contributor_id'    => 1,
            'status'            => 0,
            'created_at'        => '2021-10-13 00:00:00',
            'updated_at'        => '2021-10-13 00:00:00',
        ];

        $contributions[] = [
            'amount'            => 50000000,
            'description'       => "Normal Contribution",
            'deposit_date'      => Carbon::create("2021", "10", "13"),
            'due_date'          => Carbon::create("2022", "10", "13"),
            'profits_percent'   => 100,
            'contributor_id'    => 1,
            'status'            => 0,
            'created_at'        => '2021-10-13 00:00:00',
            'updated_at'        => '2021-10-13 00:00:00',
        ];

        Contribution::insert($contributions);
    }
}
