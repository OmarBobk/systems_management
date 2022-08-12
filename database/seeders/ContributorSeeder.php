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
            'name'           => 'Owner',
            'phone'          => '5353402539',
            'notes'          => 'Owner',
        ];

        $contributors[] = [
            'id'             => 2,
            'name'           => 'ConX',
            'phone'          => '5353402539',
            'notes'          => 'MR X is a normal contributor.',
        ];

        Contributor::insert($contributors);
    }
}
