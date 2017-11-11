@extends('admin.layout')
@section('content')

<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Editar Prescripción</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('medical_prescription.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>		
		</div>

			{{-- Form para crear nuevoa cuota Igss --}}	
		<div class="col-lg-12">
			<hr>
		</div>

	<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
				
			<form data-parsley-validate class="form-horizontal" action="{{ route ('medical_prescription.update', $prescription_edit->id_prescription) }}" method="POST" autocomplete="off">
			<input name="_method" type="hidden" value="PATCH">
    		{{csrf_field()}}
				
				<div class="form-group">
					<small>* Campos obligatorios.</small>
				</div>

				<div class="form-group {{ $errors-> has('enfermedad') ? 'has-error' : '' }} ">
					<label for="enfermedad">enfermedad *:</label>
					<select name="enfermedad" id="enfermedad" class="form-control" required="required">
						<option value="">--elegir--</option>
						@foreach($list_disease as $disease)							
							@if($disease->id_disease == $prescription_edit->disease_id)
								<option selected="selected" value="{{$disease->id_disease}}">{{$disease->description}}</option>
                            @else
                                <option value="{{$disease->id_disease}}">{{$disease->description}}</option>
                            @endif
						@endforeach								
					</select>
					<span class="text-danger">{{ $errors->first('enfermedad') }}</span>
				</div>
								
				{{--receta--}}
				<div class="form-group {{ $errors->has('receta') ? 'has-error' : '' }}">
					<label for="receta">Descripción *:</label>
					<input type="text" id="receta" class="form-control" name="receta" placeholder="Jefe de Operaciones" value="{{ $prescription_edit->recet }}" required="required">
					<span class="text-danger">{{ $errors->first('receta') }}</span>
				</div>

				<div class="form-group {{ $errors->has('observaciones') ? 'has-error' : '' }}">
					<label for="observaciones">Observaciones *:</label>
					<input type="text" id="observaciones" class="form-control" name="observaciones" placeholder="Jefe de Operaciones" value="{{ $prescription_edit->observations }}" required="required">
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
        <script src="{{asset('/admin/js/date_edit.js')}}"></script>
        {{-- <script src="{{asset('/admin/js/history.js')}}"></script> --}}
    @endpush

@stop
