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
            'name'           => 'Ahmad Omar Karman',
            'phone'          => '5353402539',
            'notes'          => 'Owner',
        ];

        $contributors[] = [
            'id'             => 2,
            'name'           => 'Yusuf Karman',
            'phone'          => '5353402539',
            'notes'          => 'Owner Brother',
        ];

        Contributor::insert($contributors);
    }
}
