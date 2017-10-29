@extends('admin.layout')
@section('content')
	<div class="container-fluid">
		<div class="col-lg-12">
			<h3>Generar Planilla</h3>
			<div class="col-lg-7"{{--  style="border: 1px solid #333333;" --}}>
				@include('backend.payroll._search')
			</div>
			<div class="col-lg-5"{{--  style="border: 1px solid #333333;" --}}>
				<a href="{{route('planillas.index')}}" class="btn btn-success btn-lg pull-right"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Consultar</a>
			</div>
		</div>

		<div class="col-lg-12">
			<hr>
		</div>

		<!-- Tabla responsiva -->
		<div class="col-lg-12">
			<div class="table-responsive">
				<!-- Contar registros -->
				<div class="col-lg-3">
					@if($employees_list->total()>0)
						<h4>Hay <span class="badge label label-primary">{{ $employees_list->total() }}</span> registros.</h4>
					@else
						<h4>Hay <span class="badge label label-default">{{ $employees_list->total() }}</span> registros.</h4>
					@endif
				</div>

				<!-- tabla con totales -->
				<table class="table table-bordered table-hover table-striped table-condensed">
					<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
						<tr>
							<th>No.</th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Inicio de Labores</th>
							<th>Sueldo Ordinario</th>
							<th>Bonificación</th>
							<th>Total Sueldo</th>
							<th>Retención ISR</th>
							<th>IGSS</th>
							<th>Salario Líquido</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>					
						@foreach($employees_list as $emp)
							<tr>
								<td>No</td>
								<td> {{ $emp->id_employee }} </td>
								<td> {{ $emp->name ." ".$emp->last_name }} </td>
								<td> {{ date('d/m/Y', strtotime($emp->start_date)) }} </td>
								<td>{{ $salarys_list->ordinary_salary }} </td>
								<td>250</td>
								<td>{{ $salarys_list->ordinary_salary }} </td>
								<td>250</td>
								<td>{{ $igss_list->quota }} </td>
								<td>3000</td>
								<td>Editar</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>				
				{{ $employees_list->appends(Request::only([ 'year', 'mes' ]))->render() }}
			</div>
		</div>
	</div><!-- /container-fluid -->
@stop