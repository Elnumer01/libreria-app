<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Eric",
            'email' => "elnumero1@gmail.com",
            'rol_id' => 1,
            'password'=>bcrypt('12345678')
        ]);

        $user = User::create([
            'name' => "Mena",
            'email' => "mena@gmail.com",
            'rol_id' => 2,
            'password'=>bcrypt('12345678')
        ]);

        $user = User::create([
            'name' => "Jocelyn",
            'email' => "Jocelyn@gmail.com",
            'rol_id' => 1,
            'password'=>bcrypt('12345678')
        ]);

        $user = User::create([
            'name' => "Ricardo",
            'email' => "ricardo@gmail.com",
            'rol_id' => 2,
            'password'=>bcrypt('12345678')
        ]);
    }
}
