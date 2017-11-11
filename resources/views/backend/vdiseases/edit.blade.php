@extends('admin.layout')
@section('content')

<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Editar Diagnostico</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('pathologic_lists.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>		
		</div>

			{{-- Form para crear nuevoa cuota Igss --}}	
		<div class="col-lg-12">
			<hr>
		</div>

	<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
				
			<form data-parsley-validate class="form-horizontal" action="{{ route ('pathologic_lists.update', $disease_edit->id_disease) }}" method="POST" autocomplete="off">
			<input name="_method" type="hidden" value="PATCH">
    		{{csrf_field()}}
				
				<div class="form-group">
					<small>* Campos obligatorios.</small>
				</div>

				<div class="form-group {{ $errors-> has('tipo') ? 'has-error' : '' }} ">
					<label for="tipo">Tipo *:</label>
					<select name="tipo" id="tipo" class="form-control" required="required">
						<option value="">--elegir--</option>
						@foreach($list_level as $level)							
							@if($level->id_level == $disease_edit->level_id)
								<option selected="selected" value="{{$level->id_level}}">{{$level->description}}</option>
                            @else
                                <option value="{{$level->id_level}}">{{$level->description}}</option>
                            @endif
						@endforeach								
					</select>
					<span class="text-danger">{{ $errors->first('tipo') }}</span>
				</div>
								
				{{--descripcion--}}
				<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
					<label for="descripcion">Descripción *:</label>
					<input type="text" id="descripcion" class="form-control" name="descripcion" placeholder="Jefe de Operaciones" value="{{ $disease_edit->description }}" required="required">
					<span class="text-danger">{{ $errors->first('descripcion') }}</span>
				</div>

				<div class="form-group {{ $errors->has('causa') ? 'has-error' : '' }}">
					<label for="causa">Causas *:</label>
					<input type="text" id="causa" class="form-control" name="causa" placeholder="Jefe de Operaciones" value="{{ $disease_edit->cause }}" required="required">
					<span class="text-danger">{{ $errors->first('causa') }}</span>
				</div>

				<div class="form-group {{ $errors->has('primer_sintoma') ? 'has-error' : '' }}">
					<label for="primer_sintoma">Sintoma #1 *:</label>
					<input type="text" id="primer_sintoma" class="form-control" name="primer_sintoma" placeholder="Jefe de Operaciones" value="{{ $disease_edit->first_sintom }}" required="required">
					<span class="text-danger">{{ $errors->first('primer_sintoma') }}</span>
				</div>

				<div class="form-group {{ $errors->has('segundo_sintoma') ? 'has-error' : '' }}">
					<label for="segundo_sintoma">Sintoma #2 *:</label>
					<input type="text" id="segundo_sintoma" class="form-control" name="segundo_sintoma" placeholder="Jefe de Operaciones" value="{{ $disease_edit->second_sintom }}" required="required">
					<span class="text-danger">{{ $errors->first('segundo_sintoma') }}</span>
				</div>

				<div class="form-group {{ $errors->has('tercer_sintoma') ? 'has-error' : '' }}">
					<label for="tercer_sintoma">Sintoma #3 *:</label>
					<input type="text" id="tercer_sintoma" class="form-control" name="tercer_sintoma" placeholder="Jefe de Operaciones" value="{{ $disease_edit->third_sintom }}" required="required">
					<span class="text-danger">{{ $errors->first('tercer_sintoma') }}</span>
				</div>

				
				{{-- <div class="form-group {{ $errors->has('fecha') ? 'has-error' : '' }}">
					<label for="fecha" class="control-label col-sm-4">Fecha *:</label>
					<div class="col-sm-8">
						<div id="sandbox-container">
							<div class="input-group date">
								<input type="text" name="fecha" id="fecha" class="form-control" value="{{ date('d/m/Y', strtotime($disease_edit->day_detected)) }}" required="required"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							</div>
						</div>
					</div>
					<span class="text-danger">{{ $errors->first('fecha') }}</span>
				</div> --}}

				{{-- Fecha --}}
				<div class="form-group {{ $errors->has('fecha') ? 'has-error' : '' }}">
					<label for="fecha">Fecha *:</label>  {{-- class="control-label col-sm-2" --}}
					{{-- <div class="col-sm-5"> --}}
						<div id="sandbox-container">
							<div class="input-group date">
								<input type="text" name="fecha" id="fecha" class="form-control" value="{{ date('d/m/Y', strtotime($disease_edit->day_detected)) }}" required="required"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							</div>
						</div>
					{{-- </div> --}}
					<span class="text-danger">{{ $errors->first('fecha') }}</span>
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
        <script src="{{asset('/admin/js/date_edit.js')}}"></script>
        {{-- <script src="{{asset('/admin/js/history.js')}}"></script> --}}
    @endpush

@stop
