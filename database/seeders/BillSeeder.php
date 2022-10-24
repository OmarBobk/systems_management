<?php

namespace Database\Seeders;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $bills = [];

        $now = Carbon::now();

        $bills[] = [
            'type'                => 'default',
            'amount'              => 0,
            'description'         => 'Products that can be sold without any costs like: invoice and others',
            'quantity'            => 10000,
            'serial'              => 1001,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        $bills[] = [
            'type'                => 'stocktaking',
            'amount'              => 100000000,
            'description'         => 'All products at the stock in the time of starting the website.',
            'quantity'            => 10000,
            'serial'              => 1002,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        Bill::insert($bills);
    }
}
