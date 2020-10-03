<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(ObrasTipoBienCulturalSeeder::class);
        $this->call(ObrasTipoObjetoSeeder::class);
        $this->call(ObrasEpocaSeeder::class);
        $this->call(ObrasTemporalidadSeeder::class);
        $this->call(ObrasResponsablesEcroSeeder::class);
        $this->call(ObrasSolicitudesAnalisisTipoAnalisisSeeder::class);
    }
}
