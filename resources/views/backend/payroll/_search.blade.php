
{{-- Formulario de busqueda para cuotas Igss.
	 Las buesquedas se hacen por el campo mes y año, valores numericos.
	 --}}
{!! Form::open([ 'route' => 'planillas.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search', 'autocomplete' => 'off', 'data-parsley-validate' =>'' ]) !!}

	<div class="form-group  {{ $errors->has('year') ? 'has-error' : '' }} ">
  		<label for="año">Año *:</label>
  			<select class="form-control" name="year" id="year" required="required">
                <option value="">--año--</option>
                    @php
                    	for($anio=(date('Y')+1); 2016<=$anio; $anio--) 
                    		{
	                            if($anio == Request::get('year')){
	                            	echo "<option selected=\"selected\" value=$anio>".$anio."</option>";
	                            }else{
	                                 echo "<option value=$anio>".$anio."</option>";
                            	}
                            }
                    @endphp
            </select>			
			<span class="text-danger">{{ $errors->first('year') }}</span>
  	</div>
	
	<!-- Select: mes de planilla: -->
	<div class="form-group {{ $errors->has('mes') ? 'has-error' : '' }} ">
		<label for="mes" class="control-label">Mes *:</label>
			<select name="mes" id="mes" class="form-control" required="required">
				<option value="">--mes--</option>
				@foreach($months as $mt => $month)
					@if($mt == Request::get('mes'))
						<option selected="selected" value="{{ $mt }}">{{ $months[$mt] }}</option>
					@else
						<option value="{{ $mt }}">{{ $months[$mt] }}</option>
					@endif
				@endforeach
			</select>		
		<span class="text-danger">{{ $errors->first('mes') }}</span>
	</div>

	<div class="form-group">
  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Generar Planilla</button>
  		<a href="{{route('planillas.index')}}" class="btn btn-warning">
  			<i class="fa fa-times" aria-hidden="true"></i></span>Limpiar
  		</a>
  	</div>

{{ Form::close() }}
