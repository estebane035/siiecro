<?php

use Illuminate\Database\Seeder;

class ObrasTipoBienCulturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Arqueológico",
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Documental",
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Histórico",
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Artístico",
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Religioso",
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Industrial",
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'      	=>  "Etnográfico",
        ]);
    }
}
