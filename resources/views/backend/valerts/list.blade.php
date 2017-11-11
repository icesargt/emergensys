@extends('admin.layout')
	@section('content')
		<div class="container-fluid">
			<div class="col-lg-12">
				<h3>Listado de Pacientes</h3>
			
				<div class="col-lg-7">
					@include('backend.vpatients.search_patients')
				</div>
				<div class="col-lg-5">
					<a href="{{ route('patient_lists.create') }}" class="btn btn-success btn-md pull-right">
						<span class="glyphicon glyphicon-plus" aria-hidden='true'></span> Agregar
					</a>
				</div>
			</div>

			<div class="col-lg-12">
				<hr>
			</div>

			<div class="col-lg-12">
			<div class="table-responsive">				
				<div class="col-lg-4">
					@if($list_patients->total() > 0)
						<h4>Hay <span class="badge label label primary">{{ $list_patients->total() }}</span> registros.</h4>
					@else
						<h4>Hay <span class="badge label label primary"> 0 </span> registros.</h4>
					@endif
				</div> <!-- Fin conteo-->
				
					<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
						<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
							<th>#</th>
							<th>DPI</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Género</th>
							<th>Teléfono</th>
							<th>E-mail</th>
							<th>Fecha de Alta</th>
							<th>Acciones</th>
						</thead>
						<tbody>
							@foreach($list_patients as $patient)
								<tr>
									<td>{{ $patient->id_patient }}</td>
									<td>{{ $patient->dpi }}</td>
									<td>{{ $patient->first_name . ", " . $patient->second_name }}</td>
									{{-- <td>{{ $patient->second_name }}</td> --}}
									<td>{{ $patient->last_name }}</td>
									<td>{{ $patient->sex }}</td>
									<td>{{ $patient->mobile_number }}</td>
									<td>{{ $patient->email }}</td>

									<td>{{ date('d/m/Y', strtotime( $patient->created_at ) ) }}</td>
									{{-- <td>{{ date('d/m/Y', strtotime( $patient->updated_at ) ) }}</td> --}}
									<td>

									<a href="{{route('sending_alerts.edit', $patient->id_patient )}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Enviar SMS</a>

									
										{{-- <form class="" action="{{route('patient_lists.destroy', $patient->id_patient )}}" method="post">
			                                <input type="hidden" name="_method" value="delete">
			                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

			                                

			                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro');" name="delete">
			                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
			                                </button>
                            			</form> --}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $list_patients->appends( Request::only('busqueda'))->render() }}
				</div>
			</div>
		</div><!-- /container-fluid -->
@stop