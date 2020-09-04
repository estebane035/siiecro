<?php

use Illuminate\Database\Seeder;

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
            'name'          =>  "Luis García Rodriguez Alias el Tocayo",
            'email'         =>  "correo@correo.com",
            'password'      =>  Hash::make('1234'),
            'rol'           =>  'Administrador'
        ]);

        DB::table('users')->insert([
            'name'          =>  "Esteban Bocardo Medel",
            'email'         =>  "esteban@gmail.com",
            'password'      =>  Hash::make('asdasd'),
            'rol'           =>  'Administrador'
        ]);

        DB::table('users')->insert([
            'name'          =>  "Kevin Arnold Sahagun",
            'email'         =>  "Kevin@correo.com",
            'password'      =>  Hash::make('1234'),
            'rol'           =>  'Administrador'
        ]);
    }
}
