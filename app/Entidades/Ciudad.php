<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $primaryKey = 'n_id';
    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';

    protected $fillable = ['t_nombre','b_habilitado'];
    
}
