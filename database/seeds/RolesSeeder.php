<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nombre'      	=>  "Director Académico",
            'descripcion' 	=>  "Director académico de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Director General",
            'descripcion' 	=>  "Director general de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Secretaria",
            'descripcion' 	=>  "Secretaria general de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Seminarios-Taller",
            'descripcion' 	=>  "Seminarios",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Laboratorios",
            'descripcion' 	=>  "Laboratoristas de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Alumno",
            'descripcion' 	=>  "Alumno de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Maestro de Restauración",
            'descripcion' 	=>  "Maestro de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Asesor Cientifico",
            'descripcion' 	=>  "Asesor científico de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Servicio Social SIIECRO",
            'descripcion' 	=>  "Prestador de servicio Social del SIIECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Administrador",
            'descripcion' 	=>  "Administrador de la sistema del SIIECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'        =>  "Externo",
            'descripcion'   =>  "Usuario externo al sistema SIIECRO",
        ]);
    }
}
