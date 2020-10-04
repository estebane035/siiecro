<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasUsuariosAsignados extends Model
{
    protected $table = 'obras__usuarios_asignados';
    protected $fillable = [
    	'obra_id',
    	'usuario_id'
    ];

    public function obra() {
        return $this->hasOne('App\Obras', 'id', 'obra_id');
    }

    public function usuario() {
        return $this->hasOne('App\User', 'id', 'usuario_id');
    }
}
