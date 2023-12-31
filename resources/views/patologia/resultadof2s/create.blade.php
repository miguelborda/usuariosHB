@extends('layouts.app')

@section('title', 'Crear Formulario2')
@push('style')
    <link rel="stylesheet" href="css/datatable.css" />
@endpush

@section('content')
<div class="title-wrapper pt-30">
    <div class="row align-items-center" style="height: 60px">
        <div class="col-md-12">
            <div class="titlemb-30">
                <h2>Crear Resultado de Formulario URBANO</h2>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.custom-bg {
background-color: #DCEEEE; /* Cambia #ff0000 al color que desees */
border-radius: 10px; /* Cambia el valor para ajustar el radio del borde */
}
.custom-bg2 {
background-color: #DEE0E0; /* Cambia #ff0000 al color que desees */
border-radius: 10px; /* Cambia el valor para ajustar el radio del borde */
}
/* Estilo para campos deshabilitados con una clase personalizada */
input.custom-disabled:disabled {
    background-color: #e0f2f1; /* Cambia este valor al color deseado */
    /* Otros estilos adicionales según tus necesidades */
}
.col-md-1-5 {
    flex: 0 0 10%;
    max-width: 10%;
}
.col-md-2-5 {
    flex: 0 0 15%;
    max-width: 15%;
}
</style>
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'patologia.resultadof2s.store']) !!}        
            <div class="row custom-bg">
                <div class="col-md-1-5">
                    <div class="form-group">
                        <strong>{!! Form::label('num_examen', 'Nº Exam') !!}</strong>
                    {{--{!! Form::text('num_examen', isset($formulario2) ? $resultadof2s->num_examen : '', ['class' => 'form-control', 'placeholder' => '']) !!}--}}
                    {!! Form::text('num_examen', '', ['class' => 'form-control examen', 'id' => 'nro_examen']) !!}
                        <small class="text-danger">{{ $errors->first('num_solicitud') }}</small>                        
                    </div>
                </div>            
                <div class="col-md-2-5">
                    <div class="form-group">
                        <strong>{!! Form::label('fecha_resultado', 'Fecha Resultado') !!}</strong>
                        {!! Form::date('fecha_resultado', '', ['id' => 'fecha','max' => now()->toDateString(), 'min' => '1900-01-01']) !!}               
                        @error('fecha_resultado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2-5"> 
                    <div class="form-group">
                        <strong>{!! Form::label('ci', 'CI') !!}</strong>
                        {!! Form::text('ci', ' ', ['id' => 'ci_paciente', 'class' => 'form-control cedula','disabled' => 'disabled']) !!}                
                    </div>
                </div>
                <div class="col-md-3"> 
                    <div class="form-group">
                        <strong>{!! Form::label('nombre', 'Nombre(s) Paciente') !!}</strong>
                        {!! Form::text('nombre', null, ['class' => 'form-control nombrepaciente','disabled' => 'disabled']) !!}                
                    </div>
                </div>
                <div class="col-md-3"> 
                    <div class="form-group">
                        <strong>{!! Form::label('apellido', 'Apellidos Paciente') !!}</strong>
                        {!! Form::text('apellido', null, ['class' => 'form-control apellidopaciente','disabled' => 'disabled']) !!}                
                    </div>
                </div>
                <div class="col-md-1"> 
                    <div class="form-group">
                        <strong>{!! Form::label('edad', 'Edad') !!}</strong>
                        {!! Form::text('edad', null, ['class' => 'form-control edadpaciente','disabled' => 'disabled']) !!}                
                    </div>
                </div>            
                <div><br></div>
            </div>
            <div><strong class="">DIAGNOSTICOS:</strong></div>    
            <div class="row custom-bg2" id="dynamicFields">
                <div class="col-md-1-5"> 
                    <div class="form-group">
                        <strong>{!! Form::label('codigo_diagnostico[]', 'Código') !!}</strong>
                        {!! Form::text('codigo_diagnostico','', ['class' => 'form-control codigo', 'id'=>'codigo_diag']) !!}
                        <small class="text-danger">{{ $errors->first('codigo_diagnostico') }}</small>
                    </div>
                </div>
                <div class="col-md-10"> 
                    <div class="form-group">
                        <strong>{!! Form::label('descripcion_diagnostico', 'Descripción de Diagnostico') !!}</strong>
                        {!! Form::text('descripcion_diagnostico', '', ['id'=> 'comentario', 'class' => 'form-control descripcion','disabled' => 'readonly']) !!}                
                    </div>
                </div>
                <br>  
            </div>
            <div class="m-3">
                <button id="agregarDato" type="button" class="btn btn-primary">Agregar</button>
                <button id="C" type="button" class="btn btn-secondary ">Cancelar</button><br>
            </div>   
            <h4>Registros temporales</h4>
            <table class="table table-sm table-striped border" id="mytable" >
                <thead>
                <tr class="titulo">
                    <th scope="col">Nro.</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Accion</th>
                </tr>
               <tr class="vacio">
                    <td colspan="4"> No hay datos registrados</td>
                </tr>
            </table>            
            <br>
            {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
            {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'onclick' => 'window.history.go(-1);']) !!}
            @if(session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
            {{-- <button type="button" class="btn btn-success btn-lg" target="_blank">Imprimir Lista</button> --}}
                <a href="{{ route('patologia.resultadof2s.pdf') }}" class="btn btn-success btn-lg" target="_blank">Imprimir Informe</a> 
            @endif

        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('script')    
   
<script>
$(document).ready(function() {

    //* PROCESO PARA SABER SI YA ESTA REGISTRADO EL SERVICIO Y LA GESTION DE ROL TURNO
    $('.examen').change(function() {
        var valorinput = $('.examen').val();
        console.log(valorinput);
            $.ajax({
                url: '{{ route('buscardatosf2.examen') }}',
                type:'GET',
                data: { dato: valorinput }, //document.getElementById("servicio").value
                success: function(data){
                   // alert(data['ci'])
                   if(data!='no_existe'){
                    $(".cedula").val(data['ci']);
                    $(".nombrepaciente").val(data['nombre']);
                    $(".apellidopaciente").val(data['apellido']);
                    $(".edadpaciente").val(data['edad']);
                   }else{
                    alert('no encontrado')
                   }                   
                }
             });
        });

    // PROCESO  PARA ENCONTRAR LA DESCRIPCION SEGUN EL CODIGO DIAGNOSTICO
    $('.codigo').change(function() {
        var valorinput = $('.codigo').val();
        console.log(valorinput);
        $.ajax({
            url: '{{ route('buscardatos.diagnostico') }}',
            type:'GET',
            data: { dato: valorinput }, //document.getElementById("servicio").value
            success: function(data){
                //alert(data['descripcion_diagnostico'])
                if(data!='no_existe'){
                $("#comentario").val(data['descripcion_diagnostico']);               
                }else{
                //alert('no encontrado');
                
                    $("#comentario").val('');
                // document.getElementById("comentario").value = "";              
                }                  
            }
        });
    });
    //PROCESO PARA AGREGAR DATOS A LA LISTA TEMPORAL
    var i = 1; 
    $('#agregarDato').click(function(e) {
        e.preventDefault();
        
        var num_examen = $('#nro_examen').val();
        var fecha_resultado = $('#fecha').val();
        var ci = $('#ci_paciente').val();
        var codigo = $('#codigo_diag').val();
        var descripcion = $('#comentario').val();
        console.log(num_examen + " "+ fecha_resultado+ " "+ci+ " "+codigo+" "+descripcion);
        var cant=0;
	  	$("input[name^='codigo']").each(function(){
	      	cant++;
	  	});
	  	if (cant == 0) {
	    	//toastr.error("Agregue algun medicamento", "NO EXISTE DATOS!!!");
            alert("NO EXISTE DATOS!!!");
	    	$('#adicionar').focus();
	    	return false;
	  	}
        var fila = '<tr  id="row' + i + '"><td>' + i + '</td><td>'+codigo+'<input type="hidden"  name="codigo_d[]" class="form-control" value="'+codigo+'"></td><td>'+descripcion+'<input type="hidden" name="des[]" class="form-control" value="'+descripcion+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Quitar</button></td></tr>';
        i++;
        $('.vacio').hide();
        $('#mytable .titulo').after(fila);
        document.getElementById("codigo_diag").value = "";
        document.getElementById("comentario").value = "";   
        $.ajax({
                url: '{{ route('buscardatos.diagnostico') }}',
                type:'GET',
                data: { dato: valorinput }, //document.getElementById("servicio").value
                success: function(data){
                   // alert(data['ci'])
                   if(data!='no_existe'){                    
                    $("#comentario").val(data['descripcion_diagnostico']);
                   }else{
                    alert('no encontrado')
                   }                   
                }
             }); 
           
    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        //cuando da click obtenemos el id del boton
        $('#row' + button_id + '').remove(); //borra la fila
        //limpia el para que vuelva a contar las filas de la tabla
    });

    //PROCESO PARA REGISTRAR MULTIPLES DATOS MEDIANTE AJAX
    $("#botonregistrar").click(function(e){
       // e.preventDefault();
		//para controlar si se agrego medicamentos
	  	var cant=0;
	  	$("input[name^='codigo']").each(function(){
	      	cant++;
	  	});
	  	if (cant == 0) {
	    	//toastr.error("Agregue algun medicamento", "NO EXISTE DATOS!!!");
            alert('NO EXISTE DATOS!!')
	    	return false;
	  	}

	    //$('#boton1').attr('disabled', true).text('Registrando...');
	    var f= $(this);
	    var formData = new FormData(document.getElementById("formulario_resultados"));
	    $.ajax({
	        url:"{{route('patologia.resultadof1s.store')}}",
	        type:'POST',
	        dataType: "html",
	        cache: false,
	        contentType: false,
	        processData: false,
	        data:formData

	    }).done(function(resp){
            if(resp=='ok'){  ///poner aqui el toarts
                alert('registrado correctamente');
                setTimeout(function(){	
			    	window.location="{{ route('patologia.resultadof1s.create') }}";
			    },300000);
            }else{
                alert('hubo un error de registro');
            }
		
	    });       
        document.getElementById("nro_examen").value = "";
        document.getElementById("fecha").value = "";
        document.getElementById("ci_paciente").value = "";
        document.getElementById("nombre_paciente").value = "";
        document.getElementById("apellido_paciente").value = "";
        document.getElementById("edad_paciente").value = "";
    });
});
</script>
@endpush

