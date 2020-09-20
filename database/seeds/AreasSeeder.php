<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('areas')->insert(
        	[
        		// Seminario taller de restauracion
	        	[
	            	'campo'      	=>  "Seminario Taller Restauración",
	            	'nombre'      	=>  "Cerámica",
	            	'siglas'      	=>  "STRC",
	        	],
	        	[
	            	'campo'      	=>  "Seminario Taller Restauración",
	            	'nombre'      	=>  "Pintura Mural",
	            	'siglas'      	=>  "STRPM",
	        	],
	        	[
	            	'campo'      	=>  "Seminario Taller Restauración",
	            	'nombre'      	=>  "Pintura Pintura de Caballete",
	            	'siglas'      	=>  "STRPC",
	        	],
	        	[
	            	'campo'      	=>  "Seminario Taller Restauración",
	            	'nombre'      	=>  "Escultura Policromada",
	            	'siglas'      	=>  "STREP",
	        	],
	        	[
	            	'campo'      	=>  "Seminario Taller Restauración",
	            	'nombre'      	=>  "Papel y Documentos Gráficos",
	            	'siglas'      	=>  "STRPyDG",
	        	],
	        	[
	            	'campo'      	=>  "Seminario Taller Restauración",
	            	'nombre'      	=>  "Metales",
	            	'siglas'      	=>  "STRM",
	        	],

	        	// Practica de campo
	        	[
	            	'campo'      	=>  "Práctica Campo - Seminario Taller Restauración",
	            	'nombre'      	=>  "Cerámica",
	            	'siglas'      	=>  "PP-STRC",
	        	],
	        	[
	            	'campo'      	=>  "Práctica Campo - Seminario Taller Restauración",
	            	'nombre'      	=>  "Pintura Mural",
	            	'siglas'      	=>  "PP-STRPM",
	        	],
	        	[
	            	'campo'      	=>  "Práctica Campo - Seminario Taller Restauración",
	            	'nombre'      	=>  "Pintura Pintura de Caballete",
	            	'siglas'      	=>  "PP-STRPC",
	        	],
	        	[
	            	'campo'      	=>  "Práctica Campo - Seminario Taller Restauración",
	            	'nombre'      	=>  "Escultura Policromada",
	            	'siglas'      	=>  "PP-STREP",
	        	],
	        	[
	            	'campo'      	=>  "Práctica Campo - Seminario Taller Restauración",
	            	'nombre'      	=>  "Papel y Documentos Gráficos",
	            	'siglas'      	=>  "PP-STRPyDG",
	        	],
	        	[
	            	'campo'      	=>  "Práctica Campo - Seminario Taller Restauración",
	            	'nombre'      	=>  "Metales",
	            	'siglas'      	=>  "PP-STRM",
	        	],

	        	// Servicio social
	        	[
	            	'campo'      	=>  "Servicio Social - Seminario Taller Restauración",
	            	'nombre'      	=>  "Cerámica",
	            	'siglas'      	=>  "SS-STRC",
	        	],
	        	[
	            	'campo'      	=>  "Servicio Social - Seminario Taller Restauración",
	            	'nombre'      	=>  "Pintura Mural",
	            	'siglas'      	=>  "SS-STRPM",
	        	],
	        	[
	            	'campo'      	=>  "Servicio Social - Seminario Taller Restauración",
	            	'nombre'      	=>  "Pintura Pintura de Caballete",
	            	'siglas'      	=>  "SS-STRPC",
	        	],
	        	[
	            	'campo'      	=>  "Servicio Social - Seminario Taller Restauración",
	            	'nombre'      	=>  "Escultura Policromada",
	            	'siglas'      	=>  "SS-STREP",
	        	],
	        	[
	            	'campo'      	=>  "Servicio Social - Seminario Taller Restauración",
	            	'nombre'      	=>  "Papel y Documentos Gráficos",
	            	'siglas'      	=>  "SS-STRPyDG",
	        	],
	        	[
	            	'campo'      	=>  "Servicio Social - Seminario Taller Restauración",
	            	'nombre'      	=>  "Metales",
	            	'siglas'      	=>  "SS-STRM",
	        	],

	        	// Otros

	        	[
	            	'campo'      	=>  NULL,
	            	'nombre'      	=>  "Donativo",
	            	'siglas'      	=>  "D",
	        	],
	        	[
	            	'campo'      	=>  NULL,
	            	'nombre'      	=>  "Laboratorio de Química",
	            	'siglas'      	=>  "LQ",
	        	],
	        	[
	            	'campo'      	=>  NULL,
	            	'nombre'      	=>  "Titulación",
	            	'siglas'      	=>  "T",
	        	],
	        	[
	            	'campo'      	=>  NULL,
	            	'nombre'      	=>  "Particulares",
	            	'siglas'      	=>  "P",
	        	],
        	]	
        );
    }
}
