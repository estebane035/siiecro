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
            'name'          =>  "Luis Alberto García Rodriguez",
            'email'         =>  "correo@correo.com",
            'password'      =>  Hash::make('1234'),
            'rol_id'        =>  10
        ]);

        DB::table('users')->insert([
            'name'          =>  "Esteban Bocardo Medel",
            'email'         =>  "esteban@gmail.com",
            'password'      =>  Hash::make('asdasd'),
            'rol_id'        =>  10
        ]);

        DB::table('users')->insert([
            'name'          =>  "Kevin Arnold Sahagun",
            'email'         =>  "Kevin@correo.com",
            'password'      =>  Hash::make('1234'),
            'rol_id'        =>  10
        ]);
    }
}
