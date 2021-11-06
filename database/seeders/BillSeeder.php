<?php

namespace Database\Seeders;

use App\Models\Bill;
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
            'type'                => 'default',
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
            'amount'              => 2721,
            'description'         => '293.5 $ * 9.27 TL',
            'quantity'            => 125,
            'serial'              => 1002,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => '2021-10-18 00:00:00',
            'updated_at'          => '2021-10-18 00:00:00',
        ];

        Bill::insert($bills);
    }
}
