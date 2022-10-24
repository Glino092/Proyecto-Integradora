<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'perfil' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Gustavo Lino',
            'email' => 'gl@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
            'perfil' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Rodrigo Tellez',
            'email' => 'rodrigotellez1111@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now(),
            'perfil' => 'admin'
        ]);
    }
}
