@extends('admin.layout')
@section('content')

	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Agregar Empleado</h3>
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{ route('empleados.index') }}" class="btn btn-info pull-right">
					<span class="glyphicon glyphicon-arrow-left" aria-hidden='true'></span>
					Regresar
				</a>
			</div>
		</div> <!-- /col-lg-12 header -->

		<div class="col-lg-12">
			<hr>
		</div>

		<!-- Form de registro de Empleado -->
		<div class="col-lg-12">
			<div class="center-block" style="width: 60%;">

				<form data-parsley-validate action="{{ route('empleados.store') }}" class="form-horizontal" method="POST" autocomplete="off">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<!-- Sección: Datos personales. -->
						<div class="panel panel-default">
							<div class="panel-heading">
							<h3 class="panel-title"><strong>Datos personales:</strong></h3>
						</div>
						<div class="panel-body">

							<div class="form-group">
								<div class="col-sm-8">
									<small>* Campos obligatorios.</small>
								</div>
							</div>

							{{-- Datos personales: nombre, apellido,fecha_inicio,estado,fecha_inactivo,bono, isr  --}}
							<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
								<label for="nombre" class="control-label col-sm-4">Nombre *: </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" maxlength="50" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre') }}" required="required">
								</div>
								<span class="text-danger">{{ $errors->first('nombre') }}</span>
							</div>

							<div class="form-group {{ $errors->has('apellido') ? 'has-error' : '' }}">
								<label for="apellido" class="control-label col-sm-4">Apellido *: </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" maxlength="50" name="apellido" id="apellido" placeholder="Apellido" value="{{old('apellido') }}" required="required">
								</div>
								<span class="text-danger">{{ $errors->first('apellido') }}</span>
							</div>

							<div class="form-group {{ $errors->has('fecha') ? 'has-error' : '' }}">
								<label for="fecha" class="control-label col-sm-4">Fecha de Inicio *:</label>
								<div class="col-sm-8">
									<div id="sandbox-container">
										<div class="input-group date">
											<input type="text" name="fecha" id="fecha" class="form-control" value="{{old('fecha') }}" required="required"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										</div>
									</div>
								</div>
								<span class="text-danger">{{ $errors->first('fecha') }}</span>
							</div>

						</div><!-- /pane-body-->
						</div><!-- /panel datos personales -->

						<!-- Sección: Datos personales. -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"><strong>Bonificación e ISR:</strong></h3>
							</div>
						<div class="panel-body">

							<div class="form-group {{ $errors->has('bonificacion') ? 'has-error' : '' }}">
								<label for="bonificacion" class="control-label col-sm-4">Bonificación *: </label>
								<div class="col-sm-8">
									<input type="number" class="form-control" min="250.00" max="10000.00" step="any" name="bonificacion" id="bonificacion" placeholder="250.00" value="{{old('bonificacion') }}" required="required">
								</div>
								<span class="text-danger">{{ $errors->first('bonificacion') }}</span>
							</div>

							<div class="form-group {{ $errors->has('isr') ? 'has-error' : '' }}">
								<label for="isr" class="control-label col-sm-4">Retención de ISR *: </label>
								<div class="col-sm-8">
									<input type="number" class="form-control" min="10.00" max="10000.00" step="any" name="isr" id="isr" placeholder="min 10.00 max 10000.00" value="{{old('isr') }}" required="required">
								</div>
								<span class="text-danger">{{ $errors->first('isr') }}</span>
							</div>

							<div class="from-group">
								<span>
									<button type="submit" class="btn btn-primary pull-right" value="validate">
										<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Guardar
									</button>
								</span>
							</div>

						</div><!-- /pane-body-->
						</div><!-- /panel datos personales -->
				</form><!-- /form -->
			</div><!-- /center-block -->
		</div><!-- /col-lg-12 -->
	</div> <!-- /container fluid-->

	@push('scripts')
        <script src="{{asset('/admin/js/date_create.js')}}"></script>
    @endpush
@stop
