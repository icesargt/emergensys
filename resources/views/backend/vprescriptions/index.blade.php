@extends('admin.layout')
	@section('content')
		<div class="container-fluid">
			<div class="col-lg-12">
				<h3>Listado de Patologías y Diagnósticos</h3>
			
				<div class="col-lg-7">
					@include('backend.vprescriptions.search_prescription')
				</div>
				<div class="col-lg-5">
					<a href="{{ route('medical_prescription.create') }}" class="btn btn-success btn-md pull-right">
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
					@if($list_prescriptions->total() > 0)
						<h4>Hay <span class="badge label label primary">{{ $list_prescriptions->total() }}</span> registros.</h4>
					@else
						<h4>Hay <span class="badge label label primary"> 0 </span> registros.</h4>
					@endif
				</div> <!-- Fin conteo-->
				
					<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
						<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
							<th>#</th>
							<th>Receta</th>
							<th>Observaciones</th>
							<th>Fecha de Alta</th>							
							<th>Acciones</th>
						</thead>
						<tbody>
							@foreach($list_prescriptions as $prescription)
								<tr>
									<td>{{ $prescription->id_prescription }}</td>
									<td>{{ $prescription->recet }}</td>
									<td>{{ $prescription->observations }}</td>
									

									<td>{{ date('d/m/Y', strtotime( $prescription->created_at ) ) }}</td>
									{{-- <td>{{ date('d/m/Y', strtotime( $prescription->updated_at ) ) }}</td> --}}
									<td>
										<form class="" action="{{route('medical_prescription.destroy', $prescription->id_prescription )}}" method="post">
			                                <input type="hidden" name="_method" value="delete">
			                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                                <a href="{{route('medical_prescription.edit', $prescription->id_prescription )}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>

			                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro');" name="delete">
			                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
			                                </button>
                            			</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $list_prescriptions->appends( Request::only('prescripcion'))->render() }}
				</div>
			</div>
		</div><!-- /container-fluid -->
@stop