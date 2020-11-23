<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasAnalisisARealizarMicrofotografia extends Model
{
    protected $table = 'obras__analisis_a_realizar_microfotografia';
    protected $fillable = [
    	'id',
    	'analisis_a_realizar_resultado_id',
    	'imagen',
    ];

    // public function analisis_a_realizar_resultado() {
    //     return $this->hasOne('App\ObrasAnalisisARealizarResultados', 'id', 'analisis_a_realizar_resultado_id');
    // }
}
