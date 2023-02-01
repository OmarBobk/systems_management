<?php

namespace Database\Seeders;

use App\Models\Saletype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saletypes = [];

        // Default
        $default = [
            'id'          => 1,
            'name'        => 'Default',
            'description' => 'Default Sale type is the retail selling',
        ];

        // Wholesale
        $wholesale = [
            'id'          => 2,
            'name'        => 'Wholesale',
            'description' => 'Wholesale type',
        ];

        // Invoice
        $invoice = [
            'id'          => 3,
            'name'        => 'Invoice',
            'description' => 'Invoice type: Internet, Electric, Water Bills ..etc',
        ];

        // Units
        $units = [
            'id'          => 4,
            'name'        => 'Units',
            'description' => 'Units type: Internet, Minutes, Apps cash, Google Play',
        ];

        $saletypes = [$default, $wholesale, $invoice, $units];

        Saletype::insert($saletypes);

    }
}
