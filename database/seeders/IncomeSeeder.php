<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incomes = [];
        $sales = Sale::all();

        for ($i=0;$i<200;$i++) {
            $incomes[] = [
                'amount'            => $sales[$i]->cost,
                'type'              => 'cost',
                'sale_id'           => $sales[$i]->id,
                'contribution_id'   => $sales[$i]->contribution_id,
            ];
        }

        for ($i=0;$i<200;$i++) {
            $incomes[] = [
                'amount'            => $sales[$i]->profit,
                'type'              => 'profit',
                'sale_id'           => $sales[$i]->id,
                'contribution_id'   => $sales[$i]->contribution_id,
            ];
        }

        $chunks = array_chunk($incomes, 50);
        foreach ($chunks as $chunk) {
            Income::insert($chunk);
        }
    }
}
