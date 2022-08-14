<?php

namespace Database\Seeders;

use App\Models\Brand;
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
            BrandSellerSeeder::class,
            ContributorSeeder::class,
            ContributionSeeder::class,
            CategorySeeder::class,
            BillSeeder::class,
            ProductSeeder::class,
            ProductsContainerSeeder::class,
//            DebtorSeeder::class,
//            DebtSeeder::class,
//            SaleSeeder::class,
//            IncomeSeeder::class,
            ExpenseSeeder::class,
            CartSeeder::class,
        ]);
    }
}
