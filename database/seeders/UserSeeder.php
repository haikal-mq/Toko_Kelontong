<?php

namespace Database\Seeders;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //buat 1 akun
        User::create([
            'name'=>'Admin Store',
            'email'=>'admin@toko.com',
            'password'=>Hash::make('admin123'),
        ]);
    }
}
