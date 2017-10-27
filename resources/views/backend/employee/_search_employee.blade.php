
{!! Form::open([ 'route' => 'empleados.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search', 'autocomplete' => 'off' ]) !!}
	<div class="form-group">
  		{{ Form::text('nombre', null, ['class' => 'form-control','size' => '30','placeholder' => 'Buscar' ]) }}    
  	</div>
  	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Buscar</button>
  	
  	<a href="{{route('empleados.index')}}" class="btn btn-info"><i class="fa fa-times" aria-hidden="true"></i></span> Limpiar</a>
{{ Form::close() }}
