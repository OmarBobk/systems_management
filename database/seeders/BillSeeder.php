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

        $bills[] = [
            'id'                  => 1,
            'type'                => 'goods',
            'amount'              => 0,
            'description'         => 'default',
            'quantity'            => 1,
            'serial'              => 1001,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => '2021-10-18 00:00:00',
            'updated_at'          => '2021-10-18 00:00:00',
        ];

        $bills[] = [
            'id'                  => 2,
            'type'                => 'goods',
            'amount'              => 100000,
            'description'         => 'Stocktaking',
            'quantity'            => 125,
            'serial'              => 1002,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ];

        $bills[] = [
            'id'                  => 3,
            'type'                => 'goods',
            'amount'              => 100000,
            'description'         => 'Stocktaking',
            'quantity'            => 125,
            'serial'              => 1003,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ];

        $bills[] = [
            'id'                  => 4,
            'type'                => 'goods',
            'amount'              => 100000,
            'description'         => 'Stocktaking',
            'quantity'            => 125,
            'serial'              => 1004,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ];

        Bill::insert($bills);
    }
}
