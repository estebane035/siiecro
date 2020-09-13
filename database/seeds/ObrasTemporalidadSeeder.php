<?php

use Illuminate\Database\Seeder;

class ObrasTemporalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Preclásico (2500 a.C. a 200 d.C.)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Clásico (200d.C. a 900 d.C.)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Postclásico (900d.C. a 1521 d.C.)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Preclásico tardío/Clásico temprano",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Fase Teochitlán (450-650 d.C)",
        ]);
    }
}
