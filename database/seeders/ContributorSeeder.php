<?php

namespace Database\Seeders;

use App\Models\Contributor;
use Illuminate\Database\Seeder;

class ContributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contributors = [];

        $contributors[] = [
            'id'             => 1,
            'name'           => 'Default',
            'phone'          => '000000000',
            'notes'          => 'Owner',
        ];

        Contributor::insert($contributors);
    }
}
