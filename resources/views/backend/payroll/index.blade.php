@extends('admin.layout')
@section('content')
	<div class="container-fluid">
		<div class="col-lg-12">
			<h3>Generar Planilla</h3>
			<div class="col-lg-7"{{--  style="border: 1px solid #333333;" --}}>
				@include('backend.payroll._search')
			</div>
			<div class="col-lg-5"{{--  style="border: 1px solid #333333;" --}}>
				{{-- <a href="{{route('planillas.index')}}" class="btn btn-success btn-lg pull-right"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Consultar</a> --}}
			</div>
		</div>

		<div class="col-lg-12">
			<hr>
		</div>
		
		@if($paystatus == false)
			<div class="col-lg-12">
				<div class="alert alert-success" role="alert">
		  			<h4 class="alert-heading">Guía básica para generar una planilla!</h4>
		  				<ol>
		  					<li>
		  						Elegir año y mes para generar la planilla.
		  					</li>
		  					<li>
		  						Click en el botón "Generar Planilla"
		  					</li>
		  					<li>
		  						El sistema mostrará la información de la planilla generada.
		  					</li>
		  					<li>
		  						Si desea guardar la planilla, debe elegir el botón "Guardar Planilla", que aparece al final de la tabla.
		  					</li>
		  				</ol>

		  				<hr>
	  					<p class="mb-0">Para generar una nueva planilla, pulse el botón "Limpiar" y elija nuevamente el año y mes diferentes</p>  				
				</div>			
			</div>
		@else
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
				<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
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
						</tr>
					</thead>
					<tbody>					
						@foreach($employees_list as $emp)
							<tr>
								<td>No</td>
								<td> {{ $emp->id_employee }} </td>								<!-- id empleado -->
								<td> {{ $emp->name ." ".$emp->last_name }} </td>				<!-- nombre, apellido -->
								<td> {{ date('d/m/Y', strtotime($emp->start_date)) }} </td>		<!-- fecha inicio -->
								<td> {{ $salarys_list->ordinary_salary }} </td>					<!-- sueldo base -->
								<td> {{ $emp->bonus }}</td>										<!-- bono -->
								<td> {{ $total = ($salarys_list->ordinary_salary + $emp->bonus + $emp->isr) }} </td> <!-- sueldo total -->
								<td> {{ $emp->isr }}</td>										<!-- retencion isr -->
								<td> {{ $igss_list->quota }} </td>								<!-- cuota igss -->
								<td> {{ number_format(($liquid = $total - ($emp->isr + $igss_list->quota)),2) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				<div class="from-group">
					<span>
						<button type="submit" class="btn btn-primary pull-right" value="validate">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Guardar Planilla
						</button>
					</span>
				</div>
				{{ $employees_list->appends(Request::only([ 'year', 'mes' ]))->render() }}
			</div>
		</div>
		@endif
	</div><!-- /container-fluid -->
@stop