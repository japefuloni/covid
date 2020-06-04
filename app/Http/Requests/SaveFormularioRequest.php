<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFormularioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //tRUE CUALQUIER USUARIO PUEDE CREAR UN PROYECTO
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'n_idusuario' => 'required',
            'n_idsede' => 'required',
            't_consentimiento' => 'required',
            't_irahoy' => 'required',
            't_sitios' => 'sometimes',
            't_actividades' => 'sometimes',
            't_presentadofiebre' => 'required',
            't_diasfiebre' => 'sometimes|integer|min:0|max:200',
            't_dolorgarganta' => 'required',
            't_malestargeneral' => 'required',
            't_secresioncongestionnasal' => 'required',
            't_dificultadrespirar' => 'required',
            't_tosseca' => 'required',
            't_contactopersonasinfectadas' => 'required',            
            'd_ultimocontacto' => 'sometimes'


           

        ];
    }



    public function messages(){

        return [
            'n_idusuario.required' => "No ha selecionado la persona",
            //'t_nombres.min' => "El Nombre del Docente debe tener el menos 3 caracteres",
            //'t_nombres.max' => "El Nombre del  Docente debe tener máximo 100 caracteres",
            't_consentimiento.required' => "No has dado el consentimiento",
            'n_idsede.required' => "No has seleccionado a la sede a la cual se dirige",
            't_irahoy.required' => "Debe responder si ira hoy a la Universidad",
            't_presentadofiebre.required' => "No has respondido si presento fiebre",
            't_dolorgarganta.required' => "No respondió a la pregunta sobre el dolor de garganta",
            't_malestargeneral.required' => "No has respondido sobre el malestar general",
            't_secresioncongestionnasal.required' => "No has respondido acerca de la Cosgentión Nasal",
            't_dificultadrespirar.required' => "No has Respondido acerca de la dificultad al respirar",
            't_tosseca.required' => "No has Respondido acerca de la tos seca",
            't_contactopersonasinfectadas.required' => "No has Respondido acerca de la cercanía con personas infectadas"
         ];
    }
}



