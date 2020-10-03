<?php

use Illuminate\Database\Seeder;

class ObrasSolicitudesAnalisisTipoAnalisisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'I. SOPORTE',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'II.BASE DE PREPARACIÓN',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'III. ESTRATIGRAFÍA',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'IV. REVOQUE Y ENLUCIDO',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'V. PENDIENTE',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'VI. BOL',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'VII. LÁMINAS METÁLICAS	',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'VIII. PIGMENTOS',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'IX. AGLUTINANTE',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'X. RECUBRIMIENTO',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'XI. MATERIAL ASOCIADO',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'XII. SALES',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'XIII. MATERIAL AGREGADO',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'XIV. BIODETERIORO',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	=>  'XV. OTROS',
        ]);
    }
}
