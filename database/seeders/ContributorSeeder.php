<?php

namespace Database\Seeders;

use App\Models\Contributor;
use Faker\Factory;
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
        $fake = Factory::create();
        $contributors = [];

        for ($i=0;$i<=5;$i++) {
            $contributors[] = [
                'name'           => $fake->name(),
                'phone'          => '05353402539',
                'notes'          => $fake->text(100),
            ];
        }

        $chunks = array_chunk($contributors, 50);
        foreach ($chunks as $chunk) {
            Contributor::insert($chunk);
        }
    }
}
