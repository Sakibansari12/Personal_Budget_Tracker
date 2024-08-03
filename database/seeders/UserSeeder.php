<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'Super Admin',
            'user_name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'status'=>1,
            'user_type' => 'Superadmin',
            'password' => Hash::make('123456'),
            
        ]); 
    }
}
