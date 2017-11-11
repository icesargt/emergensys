@extends('admin.layout')
@section('content')

	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Nuevo Prescripción Médica</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('medical_prescription.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>		
		</div>
			
		<div class="col-lg-12">
			<hr>
		</div>

		<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
					<form data-parsley-validate class="form-horizontal" action="{{ route('medical_prescription.store') }}" method="POST" autocomplete="off" novalidate="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<small>* Campos obligatorios.</small>
						</div>

						<div class="form-group {{ $errors-> has('enfermedad') ? 'has-error' : '' }} ">
							<label for="enfermedad">Enfermedad *:</label>
							<select name="enfermedad" id="enfermedad" class="form-control" required="required">
								<option value="">--elegir--</option>
								@foreach($list_disease as $disease)
									<option value="{{$disease->id_disease}}">{{$disease->description}}</option>
								@endforeach								
							</select>
							<span class="text-danger">{{ $errors->first('enfermedad') }}</span>
						</div>
												
						{{--Descripcion y sintomas--}}
						<div class="form-group {{ $errors->has('receta') ? 'has-error' : '' }}">
							<label for="receta">Receta *:</label>
							<input type="text" id="receta" class="form-control" name="receta" placeholder="Jefe de Operaciones" value="{{ old('receta') }}" required="required">
							<span class="text-danger">{{ $errors->first('receta') }}</span>
						</div>

						<div class="form-group {{ $errors->has('observaciones') ? 'has-error' : '' }}">
							<label for="observaciones">Observaciones *:</label>
							<input type="text" id="observaciones" class="form-control" name="observaciones" placeholder="Jefe de Operaciones" value="{{ old('observaciones') }}" required="required">
							<span class="text-danger">{{ $errors->first('observaciones') }}</span>
						</div>					
					
						<div class="form-group">
							<span>
			                	<button type="submit" class="btn btn-primary btn-sm pull-right" value="validate">
			                  		<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Guardar
			                	</button>
			              	</span>
						</div>
						
					</form>
				
			</div>
		</div> <!-- col-lg-12 -->
	</div>

	@push('scripts')
        <script src="{{asset('/admin/js/date_create.js')}}"></script>
    @endpush
@stop
