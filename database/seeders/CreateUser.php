<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'userName' => 'admin',
            'password' => Hash::make('admin'),
            'roles' => 'super admin',
        ]);

        User::create([
            'userName' => 'staff1',
            'password' => Hash::make('staff'),
            'roles' => 'staff',
        ]);
    }
}
