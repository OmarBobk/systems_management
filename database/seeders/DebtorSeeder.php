<?php

namespace Database\Seeders;

use App\Models\Debtor;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DebtorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake    = Factory::create();
        $debtors = [];

        for ($i=0;$i<=10;$i++) {
            $debtors[] = [
                'name'    => $fake->name(),
                'phone'   => $fake->phoneNumber(),
                'user_id' => 1,
            ];
        }

        $chunks = array_chunk($debtors, 50);
        foreach ($chunks as $chunk) {
            Debtor::insert($chunk);
        }
    }
}
