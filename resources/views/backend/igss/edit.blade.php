@extends('admin.layout')
@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3>Editar cuota Igss</h3>
		<hr>

		{{-- Form para crear nuevoa cuota Igss --}}
		<form data-parsley-validate="" class="form-horizontal" action="{{ route ('cuotas.update',$igss->id_igss) }}" method="POST" autocomplete="off">
			<input name="_method" type="hidden" value="PATCH">
            {{csrf_field()}}
			
			{{-- Rango de años 2016 al 2018 y aumenta en 1--}}
			<div class="form-group {{ $errors-> has('periodo') ? 'has-error' : '' }} ">
				<label for="año">Año:</label>
				<select name="periodo" id="periodo" class="form-control">
					<option value="">--año--</option>
					@php
						for ($anio=(date('Y')+1); 2016 <= $anio; $anio--) {
							if ($anio == $igss->year) {
								{{ <option selected="selected" value=$anio>$anio</option> }}
							}else{
								{{ <option value=$anio>$anio</option> }}
							}							
						}
					@endphp
				</select>
				<span class="text-danger">{{ $errors->first('periodo') }}</span>
			</div>

			{{--Perio de cuota = año--}}
			<div class="form-group {{ $errors->has('cuota') ? 'has-error' : '' }}">
				<label for="cuota">Cuota Igss:</label>
				<input type="number" step="0.01" min="1.00" id="cuota" class="form-control" name="cuota" placeholder="4.83" value="{{ $igss->quota }}">
				<span class="text-danger">{{ $errors->first('cuota') }}</span>
			</div>

			<div class="form-group">
				<span>
                	<button type="submit" class="btn btn-primary btn-sm">
                  		<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Guardar
                	</button>
              	</span>
			</div>
			
		</form>
	</div>
</div>

@stop
