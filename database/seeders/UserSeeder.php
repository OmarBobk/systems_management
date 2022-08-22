<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now   = now()->toArray()['formatted'];
        $users = [
            [
                "name"                  => "Admin",
                "email"                 => "admin@gmail.com",
                "is_admin"              => 1,
                "email_verified_at"     => $now,
                "password"              => bcrypt('123'),
                "created_at"            => $now,
                "updated_at"            => $now,
            ],
            [
                "name"                  => "User01",
                "email"                 => "user01@gmail.com",
                "is_admin"              => 0,
                "email_verified_at"     => $now,
                "password"              => bcrypt('123'),
                "created_at"            => $now,
                "updated_at"            => $now,
            ],
        ];

        $chunks = array_chunk($users, 50);
        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }
    }
}
