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
        $sale = fn ($id) => Sale::find($id);
        $owner = 1;

        // Sale 1
        $incomes[] = [
            'amount'            => $sale(1)->cost,
            'type'              => 'cost',
            'sale_id'           => $sale(1)->id,
            'contribution_id'   => $sale(1)->contribution_id,
        ];
        $incomes[] = [
            'amount'            => $sale(1)->profit,
            'type'              => 'profit',
            'sale_id'           => $sale(1)->id,
            'contribution_id'   => $sale(1)->contribution_id,
        ];

        // Sale 2
        $incomes[] = [
            'amount'            => $sale(2)->cost,
            'type'              => 'cost',
            'sale_id'           => $sale(2)->id,
            'contribution_id'   => $sale(2)->contribution_id,
        ];
        $incomes[] = [
            'amount'            => $sale(2)->profit,
            'type'              => 'profit',
            'sale_id'           => $sale(2)->id,
            'contribution_id'   => $sale(2)->contribution_id,
        ];

        // Sale 3
        $incomes[] = [
            'amount'            => $sale(3)->cost,
            'type'              => 'cost',
            'sale_id'           => $sale(3)->id,
            'contribution_id'   => $sale(3)->contribution_id,
        ];
        $incomes[] = [
            'amount'            => $sale(3)->profit,
            'type'              => 'profit',
            'sale_id'           => $sale(3)->id,
            'contribution_id'   => $sale(3)->contribution_id,
        ];

        // Sale 4
        $incomes[] = [
            'amount'            => $sale(4)->cost,
            'type'              => 'cost',
            'sale_id'           => $sale(4)->id,
            'contribution_id'   => $sale(4)->contribution_id,
        ];
        $incomes[] = [
            'amount'            => $sale(4)->profit,
            'type'              => 'profit',
            'sale_id'           => $sale(4)->id,
            'contribution_id'   => $sale(4)->contribution_id,
        ];

        // Sale 5
        $incomes[] = [
            'amount'            => $sale(5)->cost,
            'type'              => 'cost',
            'sale_id'           => $sale(5)->id,
            'contribution_id'   => $sale(5)->contribution_id,
        ];
        $incomes[] = [
            'amount'            => $sale(5)->profit,
            'type'              => 'profit',
            'sale_id'           => $sale(5)->id,
            'contribution_id'   => $sale(5)->contribution_id,
        ];

        // Sale 6
        $incomes[] = [
            'amount'            => $sale(6)->cost,
            'type'              => 'cost',
            'sale_id'           => $sale(6)->id,
            'contribution_id'   => $sale(6)->contribution_id,
        ];
        $incomes[] = [
            'amount'            => $sale(6)->profit * $sale(6)->contribution->profits_percent / 100,
            'type'              => 'profit',
            'sale_id'           => $sale(6)->id,
            'contribution_id'   => $owner,
        ];
        $incomes[] = [
            'amount'            => $sale(6)->profit,
            'type'              => 'profit',
            'sale_id'           => $sale(6)->id,
            'contribution_id'   => $sale(6)->contribution_id,
        ];

        $chunks = array_chunk($incomes, 50);
        foreach ($chunks as $chunk) {
            Income::insert($chunk);
        }
    }
}
