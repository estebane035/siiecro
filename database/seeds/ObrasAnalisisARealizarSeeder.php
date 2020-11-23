<?php

use Illuminate\Database\Seeder;

class ObrasAnalisisARealizarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// parent
        DB::table('obras__analisis_a_realizar')->insert([
            'id'            =>  1,
            'nombre'      	=>  "Morfológico",
        ]);
        // parent
        DB::table('obras__analisis_a_realizar')->insert([
            'id'            =>  2,
            'nombre'        =>  "Microquímico",
        ]);
        // parent
        DB::table('obras__analisis_a_realizar')->insert([
            'id'            =>  3,
            'nombre'        =>  "Micro elemental",
        ]);
        // parent
        DB::table('obras__analisis_a_realizar')->insert([
            'id'            =>  4,
            'nombre'        =>  "Molecular",
        ]);
        // parent
        DB::table('obras__analisis_a_realizar')->insert([
            'id'            =>  5,
            'nombre'        =>  "Microbiológico",
        ]);
        // parent
        DB::table('obras__analisis_a_realizar')->insert([
            'id'            =>  6,
            'nombre'        =>  "Tinción",
        ]);
    }
}
