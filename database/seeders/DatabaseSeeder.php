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
            CategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            DebtorSeeder::class,
            DebtSeeder::class,
            ContributorSeeder::class,
            ContributionSeeder::class,
            SaleSeeder::class,
            ProfitSeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}
