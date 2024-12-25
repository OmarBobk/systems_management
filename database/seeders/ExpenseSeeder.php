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
        $fake = Factory::create();
        $expenses = [];

        // Shopping
        $expenses[] = [
            'id'              => 1,
            'type'            => 'shopping',
            'description'     => 'Default Bill.',
            'amount'          => 0,
            'bill_id'         => 1, // Default Bill
            'sale_id'         => null,
            'contribution_id' => 1, // Owner
            'user_id'         => 1,
        ];

        $expenses[] = [
            'id'              => 2,
            'type'            => 'shopping',
            'description'     => null,
            'amount'          => 100000000,
            'bill_id'         => 2,
            'sale_id'         => null,
            'contribution_id' => 1, // Owner
            'user_id'         => 1,
        ];

        $expenses[] = [
            'id'              => 3,
            'type'            => 'shopping',
            'description'     => null,
            'amount'          => 50000000,
            'bill_id'         => 3,
            'sale_id'         => null,
            'contribution_id' => 2, // Owner
            'user_id'         => 1,
        ];

        $expenses[] = [
            'id'              => 4,
            'type'            => 'shopping',
            'description'     => null,
            'amount'          => 20000000,
            'bill_id'         => 4,
            'sale_id'         => null,
            'contribution_id' => 3, // ConX
            'user_id'         => 1,
        ];

        $expenses[] = [
            'id'              => 5,
            'type'            => 'shopping',
            'description'     => null,
            'amount'          => 35000000,
            'bill_id'         => 5,
            'sale_id'         => null,
            'contribution_id' => 4, // ConX
            'user_id'         => 1,
        ];

        // Loses
        $expenses[] = [
            'id'              => 6,
            'type'            => 'loses',
            'description'     => 'The Product is not working.',
            'amount'          => 50000,
            'sale_id'         => 8,
            'bill_id'         => null,
            'contribution_id' => 2, // Owner
            'user_id'         => 1,
        ];

//        // Store
//        $expenses[] = [
//            'id'              => '1',
//            'type'            => 'loses',
//            'description'     => 'The Product is not working.',
//            'amount'          => 50000,
//            'sale_id'         => 8,
//            'contribution_id' => 4, // ConX
//        ];

        Expense::insert($expenses);
    }
}
