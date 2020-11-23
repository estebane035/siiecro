<?php

use Illuminate\Database\Seeder;

class ObrasAnalisisARealizarTecnicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  1,
            'nombre'      				=>  "Microscopio óptico",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  1,
            'nombre'      				=>  "Metalografía",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  1,
            'nombre'      				=>  "SEM/MEB",
        ]);

        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  2,
            'nombre'      				=>  "Microquímico",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  2,
            'nombre'      				=>  "A la Gota",
        ]);


        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  3,
            'nombre'      				=>  "EDS",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  3,
            'nombre'      				=>  "XRF/FRX",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  3,
            'nombre'      				=>  "FTIR",
        ]);


        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  4,
            'nombre'      				=>  "Cromatografía de gases (CG)",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  4,
            'nombre'      				=>  "Cromatografía de líquidos (HPLC)",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  4,
            'nombre'      				=>  "RAMAN",
        ]);
        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  4,
            'nombre'      				=>  "DRX",
        ]);


        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  5,
            'nombre'      				=>  "Cultivo",
        ]);


        // child
        DB::table('obras__analisis_a_realizar_tecnica')->insert([
            'analisis_a_realizar_id'   	=>  6,
            'nombre'      				=>  "Tinción",
        ]);
    }
}
