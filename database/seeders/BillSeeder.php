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
            'description'         => 'Products that can be sold without any costs like: invoice and others',
            'quantity'            => 1000,
            'serial'              => 1002,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        $bills[] = [
            'type'                => 'goods',
            'amount'              => 50000000,
            'description'         => 'Products that can be sold without any costs like: invoice and others',
            'quantity'            => 1000,
            'serial'              => 2432,
            'seller_id'           => 3, // simex
            'contribution_id'     => 2,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        $bills[] = [
            'type'                => 'goods',
            'amount'              => 20000000,
            'description'         => 'Products that can be sold without any costs like: invoice and others',
            'quantity'            => 1000,
            'serial'              => 6534,
            'seller_id'           => 5, // kensa
            'contribution_id'     => 3,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        $bills[] = [
            'type'                => 'goods',
            'amount'              => 35000000,
            'description'         => 'Products that can be sold without any costs like: invoice and others',
            'quantity'            => 1000,
            'serial'              => 3213,
            'seller_id'           => 2, // syrox
            'contribution_id'     => 4,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        Bill::insert($bills);
    }
}
