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
            'id'                  => 1,
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
            'id'                  => 2,
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

        $bills[] = [
            'id'                  => 3,
            'type'                => 'Goods',
            'amount'              => 50000000,
            'description'         => 'New Bill for the owner',
            'quantity'            => 1000,
            'serial'              => 2432,
            'seller_id'           => 3, // simex
            'contribution_id'     => 2,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];


        $bills[] = [
            'id'                  => 4,
            'type'                => 'Goods',
            'amount'              => 20000000,
            'description'         => 'first bill for the conx contributor',
            'quantity'            => 1000,
            'serial'              => 6534,
            'seller_id'           => 5, // Kensa
            'contribution_id'     => 3,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];


        $bills[] = [
            'id'                  => 5,
            'type'                => 'Goods',
            'amount'              => 35000000,
            'description'         => 'second bill for the conx contributor',
            'quantity'            => 1000,
            'serial'              => 3213,
            'seller_id'           => 2, // Syrox
            'contribution_id'     => 4,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        Bill::insert($bills);
    }
}
