<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt(123456)
        ]);
        $user = User::create([
            'name' => 'agat',
            'email' => 'agat@gmail.com',
            'password' => bcrypt(123456)
        ]);
        Room::create([
            'id' => $user->id,
            'user_id' => $user->id,
        ]);
    }
}
