@extends('admin.layout')
@section('content')

	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Editar datos de Empleado</h3>
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
			<div class="center-block" style="width: 70%">
				<form data-parsley-validate action="{{ route('empleados.update', $employee_edit->id_employee) }}" class="form-horizontal" method="POST" autocomplete="off">
					<input name="_method" type="hidden" value="PATCH">
					<input name="emp_id" id="emp_id" type="hidden" value="{{$employee_edit->id_employee}}">
    				{{csrf_field()}}

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
									<input type="text" class="form-control" maxlength="50" name="nombre" id="nombre" placeholder="Nombre" value="{{$employee_edit->name}}" required="required">
									<span class="text-danger">{{ $errors->first('nombre') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('apellido') ? 'has-error' : '' }}">
								<label for="apellido" class="control-label col-sm-4">Apellido *: </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" maxlength="50" name="apellido" id="apellido" placeholder="Apellido" value="{{ $employee_edit->last_name }}" required="required">
									<span class="text-danger">{{ $errors->first('apellido') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('fecha_inicio') ? 'has-error' : '' }}">
								<label for="fecha_inicio" class="control-label col-sm-4">Fecha de Inicio *:</label>
								<div class="col-sm-8">
									<div id="sandbox-container">
										<div class="input-group date">
											<input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ date('d/m/Y', strtotime($employee_edit->start_date)) }}" required="required"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										</div>
									</div>
								</div>
								<span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
							</div>

							<!-- Select: estado de empleado: 1=Activo, 0=Inactivo-->
							<div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }} ">
								<label for="estado" class="control-label col-sm-4">Estado *:</label>
								@php
									$status = array(
										'0' => 'Inactivo',
										'1' => 'Activo',
									);
								@endphp
								<div class="col-sm-8">
									<select name="estado" id="estado" class="form-control" required="required">
										<option value="">--status--</option>
										@foreach($status as $st => $val)
											@if($st == $employee_edit->status)
												<option selected="selected" value="{{ $st }}">{{ $status[$st] }}</option>
											@else
												<option value="{{ $st }}">{{ $status[$st] }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<span class="text-danger">{{ $errors->first('estado') }}</span>
							</div>

							<div class="form-group {{ $errors->has('fecha_inactivo') ? 'has-error' : '' }}">
								<label for="fecha_inactivo" class="control-label col-sm-4">Fecha de Inactividad *:</label>
								<div class="col-sm-8">
									<div id="sandbox-container">
										<div class="input-group date">
											<input type="text" name="fecha_inactivo" id="fecha_inactivo" class="form-control" value="{{date('d/m/Y', strtotime($employee_edit->inactivity_date)) }}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										</div>
									</div>
								</div>
								<span class="text-danger">{{ $errors->first('fecha_inactivo') }}</span>
							</div>

							<!-- Guardar datos personales. Excepto Bono e ISR-->
							<div class="from-group">
								<span>
									<button type="submit" class="btn btn-primary btn-sm pull-right" value="validate">
										<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Guardar
									</button>
								</span>
							</div>

						</div><!-- /pane-body-->
					</div><!-- /panel datos personales -->
				</form><!-- /form -->

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Bonificación e ISR:</strong></h3>
					</div>
					<div class="panel-body">

					<form data-parsley-validate action="{{ route('newrecord', $employee_edit->id_employee) }}" class="form-horizontal" method="POST" autocomplete="off">
						{{--<input name="_method" type="hidden" value="PATCH">--}}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<!-- Sección: Salarios personales. -->

								<!-- Bonififacion -->
								<div class="form-group {{ $errors->has('bonificacion') ? 'has-error' : '' }}">
									<label for="bonificacion" class="control-label col-sm-4">Bonificación *: </label>
									<div class="col-sm-8">
										<input type="number" class="form-control" min="250.00" max="5000.00" step="any" name="bonificacion" id="bonificacion" placeholder="250.00" value="{{ $employee_edit->bonus }}" required="required">
										<span class="text-danger">{{ $errors->first('bonificacion') }}</span>
									</div>
								</div>

								<!-- ISR -->
								<div class="form-group {{ $errors->has('isr') ? 'has-error' : '' }}">
									<label for="isr" class="control-label col-sm-4">Retención de ISR *: </label>
									<div class="col-sm-8">
										<input type="number" class="form-control" min="10.00" max="1000.00" step="any" name="isr" id="isr" placeholder="150.00" value="{{ $employee_edit->isr }}" required="required">
										<span class="text-danger">{{ $errors->first('isr') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('fecha_actualizacion') ? 'has-error' : '' }}">
								<label for="fecha_actualizacion" class="control-label col-sm-4">Fecha de Asignación *:</label>
									<div class="col-sm-8">
										<div id="sandbox-container">
											<div class="input-group date">
												<input type="text" name="fecha_actualizacion" id="fecha_actualizacion" class="form-control" value="{{date('d/m/Y', strtotime($employee_edit->created_date)) }}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
											</div>
										</div>
									</div>
									<span class="text-danger">{{ $errors->first('fecha_actualizacion') }}</span>
								</div>

								<!-- Guardar datos de Bono e ISR-->
								<div class="from-group">
									<span>
										<button id="btnViewHistory" class="btn btn-warning" type="button" data-toggle="collapse" data-target="#viewHistory" aria-expanded="false" aria-controls="viewHistory">
											<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Ver Historial
										</button>
										
										<button type="submit" class="btn btn-success btn-sm pull-right" value="validate">
											<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Actualizar
										</button>
									</span>
								</div>
					</form><!-- /form -->

						<div class="col-lg-12">
							<hr>
							<div class="collapse" id="viewHistory">
								<div class="well">
									<div class="table-responsive">

									<div class="notificar"><!-- Notificar de errores al actualizar algun Historial-->
									</div>
										<div class="col-md-3">
											@if($records->total()>0)
												<h5>Hay <span class="badge label label-primary">{{ $records->total() }}</span> registros.</h5>
											@else
												<h5>Hay <span class="badge label label-default">{{ $records->total() }}</span> registros.</h5>
											@endif

										</div>										
										<table class="table table-bordered table-hover table-striped table-condensed history" style="background-color: rgba(75, 100, 111,0.10);">
											<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
												<tr>
													<th>#</th>
													<th>Bonificación</th>													
													<th>Retención ISR</th>
													<th>Fecha de alta</th>
													{{-- <th>F. de actualización</th> --}}
													<th>Actualizar</th>
												</tr>
											</thead>
											<tbody>
												
												
												@foreach($records as $record)
													<tr>
														<td>
															{{ $record->id_record }}
														</td>
														<td>
															<input type="number" class="form-control" min="250.00" max="5000.00" step="0.01" name="bono[]" placeholder="250.00" value="{{ $record->bonus }}" required="">

														</td>
														{{-- <td>
															{{ date('d/m/Y', strtotime($record->bonus_date)) }}
														</td> --}}
														<td>
															<input type="number" class="form-control" min="10.00" max="10000.00" step="0.01" name="isr[]" placeholder="250.00" value="{{ $record->isr }}" required="">
														</td>
														<td>
															{{ date('d/m/Y', strtotime($record->created_record)) }}
														</td>
														{{-- <td>
															{{ date('d/m/Y', strtotime($record->updated_at)) }}
														</td> --}}
														<td>
															<button type="button" class="btn btn-info btn-sm" name="update">
																<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
															</button>
														</td>
													</tr>
												@endforeach
												
											</tbody>
										</table>
										<hr>
										{{ $records->render() }}
									</div>
								</div>
							</div>
						</div><!-- /col-lg-12 history -->

					</div><!-- /pane-body-->
				</div><!-- /panel Bono e ISR -->
			</div><!-- /center-block -->
		</div><!-- /col-lg-12 -->
	</div> <!-- /container fluid-->

	@push('scripts')    
        <script src="{{asset('/admin/js/date_edit.js')}}"></script>
        <script src="{{asset('/admin/js/history.js')}}"></script>
    @endpush
@stop