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
        $debtors = [];

        $debtors[] = [
            "id"      => 1,
            'name'    => "Ahmad Market",
            'phone'   => '5377490740',
            'user_id' => 1,
        ];

        $debtors[] = [
            "id"      => 2,
            'name'    => "Yasser Google Play",
            'phone'   => '5374288972',
            'user_id' => 1,
        ];

        $debtors[] = [
            "id"      => 3,
            'name'    => "Shems",
            'phone'   => '5369968949',
            'user_id' => 1,
        ];

        $debtors[] = [
            "id"      => 4,
            'name'    => "Mom",
            'phone'   => '5376023354',
            'user_id' => 1,
        ];

        $debtors[] = [
            "id"      => 5,
            'name'    => "Abo Ali",
            'phone'   => '5397939835',
            'user_id' => 1,
        ];

        $debtors[] = [
            "id"      => 6,
            'name'    => "Ahmad Hammadeh",
            'phone'   => '5373366615',
            'user_id' => 1,
        ];

        $debtors[] = [
            "id"      => 7,
            'name'    => "Abo Gamal",
            'phone'   => '5393580596',
            'user_id' => 1,
        ];

        Debtor::insert($debtors);
    }
}
