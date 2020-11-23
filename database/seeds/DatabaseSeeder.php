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
        $this->call(ObrasSolicitudesAnalisisTipoAnalisisSeeder::class);

        $this->call(ObrasFormaObtencionMuestraSeeder::class);
        $this->call(ObrasTipoMaterialSeeder::class);
        $this->call(ObrasTipoMaterialInformacionPorDefinirSeeder::class);
        $this->call(ObrasTipoMaterialInterpretacionParticularSeeder::class);
        $this->call(ObrasAnalisisARealizarSeeder::class);
        $this->call(ObrasAnalisisARealizarTecnicaSeeder::class);
    }
}
