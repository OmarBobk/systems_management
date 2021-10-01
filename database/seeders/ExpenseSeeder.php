<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Expense;
use Exception;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
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
        $expenses         = [];
        $contributions_id = collect(Contribution::all()->modelKeys());
        $types            = collect(['shopping', 'store', 'loses']);

        for ($i=0;$i<=10;$i++) {
            $expenses[] = [
                'type'             => $types->random(),
                'description'      => $fake->text('100'),
                'cost'             => random_int(10, 1500),
                'contribution_id'  => $contributions_id->random(),
            ];
        }

        $chunks = array_chunk($expenses, 50);
        foreach ($chunks as $chunk) {
            Expense::insert($chunk);
        }
    }
}
