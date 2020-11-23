<?php

use Illuminate\Database\Seeder;

class ObrasTipoMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Fibra",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Madera",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Material biológico",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Tintas",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Material pétreo",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Estratigrafía",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Metal",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Cargas",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Pigmento",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Colorante",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Aglutinante",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Capas de superficie",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Adhesivo",
        ]);
        DB::table('obras__tipo_material')->insert([
            'nombre'      	=>  "Sal",
        ]);
    }
}
