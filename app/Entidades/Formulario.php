<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $primaryKey = 'n_idformulario';

 

    protected $fillable= ['t_nombres', 
                            'n_idusuario',
                            't_consentimiento',
                            't_presentadofiebre',
                            't_diasfiebre',
                            't_dolorgarganta',
                            't_malestargeneral',
                            't_secresioncongestionnasal',
                            't_dificultadrespirar', 
                            't_tosseca',
                            't_contactopersonasinfectadas',
                            'd_ultimocontacto'
                            
                        ];

    protected $guarded= ['n_idformulario', 'created_at', 'updated_at'];
    //
    protected $table = 'formulario'; //Esta line se pone si la tabla se llama de manera diferente
}
