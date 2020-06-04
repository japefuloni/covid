@csrf




<input type="hidden" id="n_idusuario" name="n_idusuario" value="{{$n_idusuario}}">


<div class="col-md-6">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Consentimiento</h3>

        <div class="card-tools">
          
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        2.	Que conforme a la Ley 1581 de 2012, de manera voluntaria, autorizo a la Universidad Pontificia Bolivariana a tratar mis datos personales. Declaro que conozco mis derechos y deberes y las políticas de Tratamiento de protección de datos de la Universidad, en mi calidad de <strong>{{$viculoconu}}</strong> conforme a la finalidad de promoción, prevención y gestión de riesgo de salud, establecida por la Resolución 666 del 24 de abril de 2020 denominada “Por el cual se adopta el protocolo general de bioseguridad para mitigar, controlar y realizar el adecuado manejo de la pandemia del Coronavirus COVID-19”, numeral 4.1 inciso 4, y conforme a los parámetros establecidos por la Organización Mundial de la Salud - OMS sobre el autocuidado que cada persona debe tener para generar los medios de protección que le permita salvaguardad su salud; por lo anterior, asumo el compromiso del Reporte diario de estado de salud, bajo el principio de la buena fe, que lo reportado en la presente encuesta corresponde a datos verídicos asumiendo la responsabilidad por cualquier dato inexacto que pueda poner en riesgo mi salud y la de los demás.
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


<label>
    Acepta consentimiento
</label><br>
<input   type="radio" name="t_consentimiento" value="SI"  {{(old('t_consentimiento') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_consentimiento" value="NO" {{(old('t_consentimiento') == 'NO') ? 'checked' : ''}}> NO<br>

    


<br>

<label>
    Indique para cuál sede o seccional solicita el ingreso
    <select name="n_idsede" class="form-control" id="n_idsede">
        <option value="" >--Seleccionar Sede--</option>
        @foreach($sedes as $sede)
             <option value="{{$sede->n_idsede }}"
                @if ($sede->n_idsede == old('n_idsede'))
                selected="selected"
            @endif
                
                >{{ $sede->t_sede }}</option> 
        @endforeach
        </select>
</label><br>
<br>
<label>
    ¿Usted irá hoy a la Universidad o a una de sus sedes?
</label><br>
<input   type="radio" name="t_irahoy" value="SI" {{(old('t_irahoy') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_irahoy" value="NO" {{(old('t_irahoy') == 'NO') ? 'checked' : ''}}> NO<br>


<br>
<label>
    Indique el o los sitios donde realizará sus actividades
<input class="form-control" type="text" name="t_sitios" placeholder="Puede digitar no" value="{{ old('t_sitios') }}">
</label>
<br>

<br>
<label>
    Actividades que realizará en la Universidad, objeto de solicitud de permiso
<input class="form-control" type="text" name="t_actividades" placeholder="Puede digitar no" value="{{ old('t_actividades') }}">
</label>
<br>

<br>
<label>
    ¿Presenta fiebre (temperatura superior a 38º C, cuantificada con termómetro)?
</label><br>
<input   type="radio" name="t_presentadofiebre" value="SI" {{(old('t_presentadofiebre') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_presentadofiebre" value="NO" {{(old('t_presentadofiebre') == 'NO') ? 'checked' : ''}}> NO<br>

<br>
<label>
    En caso de haber presentado fiebre mayor a 38°C, ¿por cuántos días la ha presentado? (formato de número en la respuesta)
</label>
<input size="10" class="form-control col-md-1" type="number" name="t_diasfiebre" placeholder="valor #" value="{{ old('t_diasfiebre') }}">

<br>
<label>
    ¿Usted tiene dolor de garganta?
</label><br>
<input   type="radio" name="t_dolorgarganta" value="SI" {{(old('t_presentadofiebre') == 'SI') ? 'checked' : ''}}> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_dolorgarganta" value="NO" {{(old('t_presentadofiebre') == 'NOgit') ? 'checked' : ''}}> NO<br>

<br>
<label>
    ¿Usted tiene malestar general?
</label><br>
<input   type="radio" name="t_malestargeneral" value="SI"> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_malestargeneral" value="NO"> NO<br>

<br>
<label>
    ¿Tiene secreciones nasales o congestión nasal? (no relacionadas con procesos alérgicos)
</label><br>
<input   type="radio" name="t_secresioncongestionnasal" value="SI"> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_secresioncongestionnasal" value="NO"> NO<br>

<br>
<label>
    ¿Usted tiene dificultad para respirar?
</label><br>
<input   type="radio" name="t_dificultadrespirar" value="SI"> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_dificultadrespirar" value="NO"> NO<br>

<br>
<label>
   ¿Tiene tos seca y persistente?

</label><br>
<input   type="radio" name="t_tosseca" value="SI"> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_tosseca" value="NO"> NO<br>

<br>
<label>
    ¿Ha estado en contacto con personas que han tenido los síntomas anteriormente mencionados o ha estado relacionado con casos de personas infectadas de Coronavirus en los últimos 7- 14 días?
</label><br>
<input   type="radio" name="t_contactopersonasinfectadas" value="SI"> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_contactopersonasinfectadas" value="NO"> NO<br>

<br>
<label>
    En caso de que en la anterior pregunta haya marcado "Sí", ¿en qué fecha se presentó el último contacto con la persona infectada? 
</label><br>
<input class="form-control col-md-2" type="date" id="d_ultimocontacto" name="d_ultimocontacto"><br>


<label>
    ¿Realizó un viaje nacional o internacional en los últimos 30 días?
</label><br>
<input   type="radio" name="t_realizoviaje" value="SI"> SI &nbsp;&nbsp;&nbsp;
<input   type="radio" name="t_realizoviaje" value="NO"> NO<br>




<br><button class="btn btn-info" type="submit">{{ $btnText }}</button>