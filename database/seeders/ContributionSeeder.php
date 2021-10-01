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
        $fake = Factory::create();
        $contributions = [];
        $contributors_id = collect(Contributor::all()->modelKeys());

        for ($i=0;$i<=10;$i++) {
            $now = Carbon::now();
            $contributions[] = [
                'amount'            => random_int(1000, 100000),
                'description'       => $fake->text(100),
                'deposit_date'      => $now,
                'due_date'          => $now->addYear(),
                'profits_percent'   => 50,
                'contributor_id'    => $contributors_id->random(),
            ];
        }

        $chunks = array_chunk($contributions, 50);
        foreach ($chunks as $chunk) {
            Contribution::insert($chunk);
        }
    }
}
