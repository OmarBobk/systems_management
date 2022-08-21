<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $sales = [];

        // Units
        $sales[] = [
            'id'                 => 1,
            'net_price'          => 10,
            'cost'               => 0,
            'amount'             => 1,
            'total'              => 10,
            'profit'             => 10,
            'type'               => 'units',
            'is_debt'            => false,
            'description'        => 'product details.',
            'user_id'            => 1,
            'product_id'         => 1,
            'contribution_id'    => 1, // Owner
        ];

        // Invoice.
        $sales[] = [
            'id'                 => 2,
            'net_price'          => 10,
            'cost'               => 0,
            'amount'             => 1,
            'total'              => 10,
            'profit'             => 10,
            'type'               => 'invoice',
            'is_debt'            => false,
            'description'        => 'The pdf Url',
            'user_id'            => 1,
            'product_id'         => 1,
            'contribution_id'    => 1, // Owner
        ];

        // Other.
        $sales[] = [
            'id'                 => 3,
            'net_price'          => 30,
            'cost'               => 0,
            'amount'             => 1,
            'total'              => 30,
            'profit'             => 30,
            'type'               => 'other',
            'is_debt'            => false,
            'description'        => 'Phone reparing, Salling SIM Card.',
            'user_id'            => 1,
            'product_id'         => 1,
            'contribution_id'    => 1, // Owner
        ];

        // Retail.
        $sales[] = [
            'id'                 => 4,
            'net_price'          => 180000,
            'cost'               => 100000,
            'amount'             => 1,
            'total'              => 180000,
            'profit'             => 80000,
            'type'               => 'retail',
            'is_debt'            => false,
            'description'        => null,
            'user_id'            => 1,
            'product_id'         => 2,
            'contribution_id'    => 1, // Owner
        ];

        $sales[] = [
            'id'                 => 5,
            'net_price'          => 90000,
            'cost'               => 50000,
            'amount'             => 1,
            'total'              => 90000,
            'profit'             => 40000,
            'type'               => 'retail',
            'is_debt'            => false,
            'description'        => null,
            'user_id'            => 1,
            'product_id'         => 3,
            'contribution_id'    => 2, // Owner
        ];

        $sales[] = [
            'id'                 => 6,
            'net_price'          => 50000,
            'cost'               => 20000,
            'amount'             => 1,
            'total'              => 50000,
            'profit'             => 30000,
            'type'               => 'retail',
            'is_debt'            => false,
            'description'        => null,
            'user_id'            => 1,
            'product_id'         => 4,
            'contribution_id'    => 3, // ConX
        ];

        $sales[] = [
            'id'                 => 7,
            'net_price'          => 90000,
            'cost'               => 50000,
            'amount'             => 1,
            'total'              => 90000,
            'profit'             => 40000,
            'type'               => 'retail',
            'is_debt'            => false,
            'description'        => null,
            'user_id'            => 1,
            'product_id'         => 5,
            'contribution_id'    => 4, // ConX
        ];

        // Loses
        $sales[] = [
            'id'                 => 8,
            'net_price'          => 0,
            'cost'               => 50000,
            'amount'             => 1,
            'total'              => 0,
            'profit'             => -50000,
            'type'               => 'retail',
            'is_debt'            => false,
            'description'        => 'The Product is not working.',
            'user_id'            => 1,
            'product_id'         => 5,
            'contribution_id'    => 4, // ConX
        ];

        $chunks = array_chunk($sales, 50);
        foreach ($chunks as $chunk) {
            Sale::insert($chunk);
        }

    }
}
