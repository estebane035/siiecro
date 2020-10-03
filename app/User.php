<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'rol_id',
        'area_id',
        'es_responsable_ecro',
        'es_responsable_intervencion',
        'puede_recibir_obras'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol() {
        return $this->hasOne('App\Roles', 'id', 'rol_id');
    }

    public function getEsResponsableEcroAttribute($value){
        return ($value == "si");
    }

    public function getEsResponsableIntervencionAttribute($value){
        return ($value == "si");
    }

    public function getPuedeRecibirObrasAttribute($value){
        return ($value == "si");
    }

    public function getIconoEsResponsableEcroAttribute(){
        if($this->es_responsable_ecro){
            return '<i class="fa fa-id-badge fa-lg m-r-sm m-l-sm pointer inline-block" aria-hidden="true" mi-tooltip="Es responsable ECRO"></i>';
        } else{
            return '';
        }
    }

    public function getIconoEsResponsableIntervencionAttribute(){
        if($this->es_responsable_intervencion){
            return '<i class="fa fa-pencil-square-o fa-lg m-r-sm m-l-sm pointer inline-block" aria-hidden="true" mi-tooltip="Es responsable intervención"></i>';
        } else{
            return '';
        }
    }

    public function getIconoPuedeRecibirObrasAttribute(){
        if($this->puede_recibir_obras){
            return '<i class="fa fa-archive fa-lg m-r-sm m-l-sm pointer inline-block" aria-hidden="true" mi-tooltip="Puede recibir obras"></i>';
        } else{
            return '';
        }
    }
}
