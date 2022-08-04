<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // SEEDER USER
        \App\Models\User::insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('caleg'),
                'nama_lengkap' => 'Admin',
                'no_telp' => '081234567890',
                'level' => 'admin',
                'blokir' => 'N',
                'id_session' => '1',
                'foto_user' => 'admin.jpg'
            ],
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('caleg'),
                'nama_lengkap' => 'user',
                'no_telp' => '081234567890',
                'level' => 'user',
                'blokir' => 'N',
                'id_session' => '2',
                'foto_user' => 'user.jpg'
            ]
        ]);
    }
}
