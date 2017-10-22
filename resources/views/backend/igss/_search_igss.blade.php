

{!! Form::open([ 'class' => 'form-horizontal', 'role' => 'search', 'method' => 'GET', 'url' => 'cuotas', 'autocomplete' => 'off' ]) !!}
	{{ Form::label('buscar','Buscar:') }}
	{{ Form::text('buscar','null', array('class' => 'form-control', 'required' => '') }}

	{{ Form::submit('Buscar', array('class' => 'btn btn-success btn-md btn-block') }}
	{{ Form::reset('Limpiar', array('class' => 'btn btn-success btn-md btn-block') }}
{{ Form::close() }}


	