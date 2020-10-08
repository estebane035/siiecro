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
            'nombre'      	     =>  'I. SOPORTE',
            'color_hexadecimal'  =>  '#C65911',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'II.BASE DE PREPARACIÓN',
            'color_hexadecimal'  =>  '#FFCC66',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'III. ESTRATIGRAFÍA',
            'color_hexadecimal'  =>  '#008000',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'IV. REVOQUE Y ENLUCIDO',
            'color_hexadecimal'  =>  '#B248A5',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'V. ENGOBE',
            'color_hexadecimal'  =>  '#FF5050',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'VI. BOL',
            'color_hexadecimal'  =>  '#991305',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'VII. LÁMINAS METÁLICAS	',
            'color_hexadecimal'  =>  '#375754',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'VIII. PIGMENTOS',
            'color_hexadecimal'  =>  '#5B9BD5',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'IX. AGLUTINANTE',
            'color_hexadecimal'  =>  '#F55587',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'X. RECUBRIMIENTO',
            'color_hexadecimal'  =>  '#FBAE47',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'XI. MATERIAL ASOCIADO',
            'color_hexadecimal'  =>  '#8686C4',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'XII. SALES',
            'color_hexadecimal'  =>  '#009999',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'XIII. MATERIAL AGREGADO',
            'color_hexadecimal'  =>  '#7D10C0',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'XIV. BIODETERIORO',
            'color_hexadecimal'  =>  '#A2C866',
        ]);
        DB::table('obras__solicitudes_analisis_tipo_analisis')->insert([
            'nombre'      	     =>  'XV. OTROS',
            'color_hexadecimal'  =>  '#A5A5A5',
        ]);
    }
}
