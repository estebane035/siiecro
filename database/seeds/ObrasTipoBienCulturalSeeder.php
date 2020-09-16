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
            'nombre'                    =>  "Arqueológico",
            'calcular_temporalidad'     =>  'si'
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Documental",
            'calcular_temporalidad'     =>  'no'
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Histórico",
            'calcular_temporalidad'     =>  'no'
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Artístico",
            'calcular_temporalidad'     =>  'no'
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Religioso",
            'calcular_temporalidad'     =>  'no'
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Industrial",
            'calcular_temporalidad'     =>  'no'
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Etnográfico",
            'calcular_temporalidad'     =>  'no'
        ]);
    }
}
