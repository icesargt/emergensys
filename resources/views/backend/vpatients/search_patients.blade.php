{{--Partials: TypesJobs. Use scope for search description --}}

{!! Form::open([ 'route' => 'patient_lists.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search', 'autocomplete' => 'off' ]) !!}
	<div class="form-group">
  		{{ Form::text('busqueda', null, ['class' => 'form-control','size' => '25','placeholder' => 'Buscar' ]) }}    
  	</div>
  	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Buscar</button>
  	<a href="{{route('patient_lists.index')}}" class="btn btn-info"><i class="fa fa-times" aria-hidden="true"></i></span> Limpiar</a>
{{ Form::close() }}
