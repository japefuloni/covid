<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $primaryKey = 'n_idsede';

    protected $fillable= ['t_sede'];

    protected $guarded= ['n_idsede'];
    //
    protected $table = 'sedes'; //Esta línea se pone si la tabla se llama de manera diferente

    /**
     * Get the comments for the blog post.
     */
    public function formulario()
    {
        return $this->hasMany('App\Entidades\Formulario','n_idsede');
    }
}
