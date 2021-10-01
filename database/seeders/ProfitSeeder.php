<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Profit;
use App\Models\Sale;
use Exception;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProfitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $fake             = Factory::create();
        $profits         = [];
        $contributions_id = collect(Contribution::all()->modelKeys());
        $sales_id         = collect(Sale::all()->modelKeys());

        for ($i=0;$i<=10;$i++) {
            $profits[] = [
                'profits'          => random_int(10, 1000),
                'sale_id'          => $sales_id->random(),
                'contribution_id'  => $contributions_id->random(),
            ];
        }

        $chunks = array_chunk($profits, 50);
        foreach ($chunks as $chunk) {
            Profit::insert($chunk);
        }
    }
}
