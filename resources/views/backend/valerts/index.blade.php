@extends('admin.layout')
	@section('content')
		<div class="container-fluid">
			<div class="col-lg-12">
				<h3>Listado de notifiaciones enviadas</h3>
			
				<div class="col-lg-7">
					@include('backend.valerts.search_alerts')
				</div>
				<div class="col-lg-5">
					{{-- <a href="{{ route('patient_lists.create') }}" class="btn btn-success btn-md pull-right">
						<span class="glyphicon glyphicon-plus" aria-hidden='true'></span> Agregar
					</a> --}}
				</div>
			</div>

			<div class="col-lg-12">
				<hr>
			</div>

			<div class="col-lg-12">
			<div class="table-responsive">				
				<div class="col-lg-4">
					@if($list_alerts->total() > 0)
						<h4>Hay <span class="badge label label primary">{{ $list_alerts->total() }}</span> registros.</h4>
					@else
						<h4>Hay <span class="badge label label primary"> 0 </span> registros.</h4>
					@endif
				</div> <!-- Fin conteo-->
				
					<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
						<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
							<th># Alerta</th>
							<th>Enviado a:</th>
							<th>Teléfono</th>
							<th>Mensaje</th>							
							<th>Fecha de Envío</th>
							<th>Enviado por:</th>
							<th>Acciones</th>
						</thead>
						<tbody>
							@foreach($list_alerts as $alert)
								<tr>
									<td>{{ $alert->id_alert }}</td>									
									<td>{{ $alert->first_name . ", " . $alert->last_name }}</td>
									<td>{{ $alert->phone_number }}</td>
									<td>{{ $alert->message }}</td>

									<td>{{ date('d/m/Y', strtotime( $alert->created_at ) ) }}</td>
									<td>{{ $alert->name }}</td>
									<td>
										<form class="" action="{{route('sending_alerts.destroy', $alert->id_alert )}}" method="post">
			                                <input type="hidden" name="_method" value="delete">
			                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                                
			                                {{-- <a href="{{route('sending_alerts.edit', $alert->id_alert )}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a> --}}

			                                <a href="{{route('sending_alerts.show', $alert->id_patient )}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>

			                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro');" name="delete">
			                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
			                                </button>
                            			</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $list_alerts->appends( Request::only('busqueda'))->render() }}
				</div>
			</div>
		</div><!-- /container-fluid -->
@stop