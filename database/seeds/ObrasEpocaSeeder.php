<?php

use Illuminate\Database\Seeder;

class ObrasEpocaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XIV",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XV",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XVI",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XVII",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XVIII",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XIX",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XX",
        ]);
        DB::table('obras__epoca')->insert([
            'nombre'      	=>  "Siglo XXI",
        ]);
    }
}
