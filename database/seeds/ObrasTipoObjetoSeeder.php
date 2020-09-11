<?php

use Illuminate\Database\Seeder;

class ObrasTipoObjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Cerámica",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Textil",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura mural",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Plafones",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura sobre lienzo",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura sobre tabla",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Técnica mixta",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Escultura policromada",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Escultura",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Escultura ligera",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Marcos",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Muebles",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Retablos",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Manuscritos",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Mapas",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Planos",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Croquis",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Cartas (Cartografías)",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Carteles",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Impresos",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Obras gráficas",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Instrumento musical",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Armas blancas",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Armas de fuego",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura sobre lámina",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Mecánico",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Utilitario",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Científico",
        ]);
    }
}
