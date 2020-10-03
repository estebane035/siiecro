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
	            	'nombre'      	=>  "Seminario Taller Restauración Cerámica",
	            	'siglas'      	=>  "STRC",
	        	],
	        	[
	            	'nombre'      	=>  "Seminario Taller Restauración Pintura Mural",
	            	'siglas'      	=>  "STRPM",
	        	],
	        	[
	            	'nombre'      	=>  "Seminario Taller Restauración Pintura de Caballete",
	            	'siglas'      	=>  "STRPC",
	        	],
	        	[
	            	'nombre'      	=>  "Seminario Taller Restauración Escultura Policromada",
	            	'siglas'      	=>  "STREP",
	        	],
	        	[
	            	'nombre'      	=>  "Seminario Taller Restauración Papel y Documentos Gráficos",
	            	'siglas'      	=>  "STRPyDG",
	        	],
	        	[
	            	'nombre'      	=>  "Seminario Taller Restauración Metales",
	            	'siglas'      	=>  "STRM",
	        	],

	        	// Otros

	        	[
	            	'nombre'      	=>  "Donativo",
	            	'siglas'      	=>  "D",
	        	],
	        	[
	            	'nombre'      	=>  "Laboratorio de Química",
	            	'siglas'      	=>  "LQ",
	        	],
	        	[
	            	'nombre'      	=>  "Titulación",
	            	'siglas'      	=>  "T",
	        	],
	        	[
	            	'nombre'      	=>  "Particulares",
	            	'siglas'      	=>  "P",
	        	],
        	]	
        );
    }
}
