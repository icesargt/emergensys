
@extends('admin.layout')
@section('content')
	<div class="container-fluid">
		<div class="col-lg-12">
			<h3>Lista de Empleados</h3>

			<div class="col-lg-6"> <!-- Partial de busqueda, de Empleados -->
				@include('backend.employee._search_employee')
			</div>

			<div class="col-lg-6">			
				<a href="{{ route('empleados.create') }}" class="btn btn-success btn-lg pull-right">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Empleado
				</a>
			</div>			
		</div><!-- /col-lg-12 titulos -->

		<div class="col-lg-12">
			<hr>
		</div>

		<!-- Tabla responsiva -->
		<div class="col-lg-12">
			<div class="table-responsive">
			<!-- Conteo de cuantos registros existen. Igual para las busquedas. -->
				<div class="col-lg-3">
					@if($employee_list->total() >0)
						<h4>Hay <span class="badge label label-primary">{{ $employee_list->total() }}</span> empleados.</h4>
					@else
						<h4>Hay <span class="badge label label-default">{{ $employee_list->total() }}</span> empleados.</h4>
					@endif
				</div>

				<!-- tabla de registros -->
				<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
					<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
						<tr>
							<th>#</th>
							<th>Empleado</th>
							<th>Fecha de Inicio</th>
							<th>Estado</th>
							<th>Bonificación</th>
							<th>Retención ISR</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($employee_list as $employee)
							<tr>
								<td>{{ $employee->id_employee }}</td>
								<td>{{ $employee->name ." ".$employee->last_name }}</td> <!-- Nombgre y Apellido -->
								<td>{{ date('d/m/Y', strtotime($employee->start_date)) }}</td>
								<td>
									@if($employee->status == 1)
										<h4><span class="label label-success">Activo</span></h4>
									@else
										<h4><span class="label label-default">Inactivo</span></h4>								
									@endif						
								</td>
								<td>{{ $employee->bonus }}</td>
								<td>{{ $employee->isr }}</td>
								<td>
									<form class="" action="{{route('empleados.destroy', $employee->id_employee)}}" method="POST">
			                                <input type="hidden" name="_method" value="delete">
			                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

			                                <a href="{{route( 'empleados.edit', $employee->id_employee )}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>

			                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro?');" name="eliminar">
			                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
			                                </button>
	                            		</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				{{$employee_list->appends(Request::only([ 'nombre' ]))->render() }}
			</div>
		</div>
	</div><!-- /container-fluid -->
@stop