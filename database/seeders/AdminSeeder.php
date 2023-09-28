<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'nombres' => 'Administrador',
            'apellidos' => 'Hospital',
            'ci'=> '123321',
            'rol'=>'ADMIN',
            'email' => 'admin@mail.bo',
            'password' => Hash::make('123321')
        ]);
    }
}
