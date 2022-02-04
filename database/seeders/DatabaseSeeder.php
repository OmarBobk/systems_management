<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SellerSeeder::class,
            BrandSeeder::class,
            ContributorSeeder::class,
            ContributionSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
//            DebtorSeeder::class,
            BillSeeder::class,
//            DebtSeeder::class,
//            SaleSeeder::class,
//            IncomeSeeder::class,
//            ExpenseSeeder::class,
        ]);
    }
}
