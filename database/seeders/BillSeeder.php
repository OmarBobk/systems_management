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
            'type'                => 'goods',
            'amount'              => 0,
            'description'         => 'Stocktaking',
            'quantity'            => 1,
            'serial'              => 1001,
            'seller_id'           => 1,
            'contribution_id'     => 1,
            'created_at'          => $now,
            'updated_at'          => $now,
        ];

        Bill::insert($bills);
    }
}
