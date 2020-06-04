<?php

namespace App\Entidades;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administradores';
    protected $primaryKey = 'n_id';
    public $incrementing = 'true';

    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';

    protected $fillable = ['t_nombrecompleto', 't_login','n_idsede','t_email','b_habilitado'];
    
    protected $guarded =['t_password'];

    protected $hidden = ['t_password',];

    public function getAuthPassword()
    {
      return $this->t_password;
    }

    /* public function sede(){
        return $this->hasMany('App\Model\UsuarioRol','n_idusuario','n_idusuario');
    } */
}
