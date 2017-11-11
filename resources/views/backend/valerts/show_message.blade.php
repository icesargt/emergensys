@extends('admin.layout')
@section('content')

<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Detalle de Mensaje Enviado</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('sending_alerts.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>
		</div>

			{{-- Form para crear nuevoa cuota Igss --}}	
		<div class="col-lg-12">
			<hr>
		</div>

	<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
				
			<form data-parsley-validate class="form-horizontal" action="{{ route('notifysys') }}" method="POST" autocomplete="off" novalidate="">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<input type="hidden" class="form-control" id="id_patient" name="id_patient" readonly="readonly" 
				value="{{ $patient_show->id_patient }}">
				
				<div class="form-group">
					<small>* Campos obligatorios.</small>
				</div>				

				<div class="form-group">
					<label for="primer_nombre">Nombre: {{ $patient_show->first_name .', '. $patient_show->second_name}}</label>		
				</div>
				

				<div class="form-group">
					<label for="apellido">Apellido: {{ $patient_show->last_name }} </label>					
				</div>				

				{{--Descripcion y sintomas--}}
				<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
					<label for="telefono">Móvil *:</label>
					<input type="number" id="telefono" class="form-control" name="telefono" placeholder="2440 9090" value="{{ $patient_show->mobile_number }}" required="required" readonly="readonly">
					<span class="text-danger">{{ $errors->first('telefono') }}</span>
				</div>

				<div class="form-group {{ ($errors->has('mensaje')) ? 'has-error' : '' }}">                    
                    <label for="lblmensaje">Mensaje *:</label>
                        <textarea required  class="form-control" name="mensaje" id="mensaje" cols="30" rows="3" readonly="readonly">{{ 'Esta es una emergencia. '. $patient_show->first_name .' '. $patient_show->last_name .'. '.  'Ha sido Internado en Centro Medico Zona 10. Llamar al 44205704.' }}</textarea>
                    {!! $errors->first('mensaje','<p class="help-block">:message</p>') !!}
                </div>

				{{-- <div class="form-group">
					<span>
	                	<button type="submit" class="btn btn-primary btn-sm pull-right" value="validate">
	                  		<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Enviar
	                	</button>
	              	</span>
				</div> --}}				
			</form>
				
		</div>
	</div> <!-- col-lg-12 -->
</div>

	{{-- @push('scripts')    
	        <script src="{{asset('/admin/js/date_edit.js')}}"></script>	        
	@endpush --}}

@stop
