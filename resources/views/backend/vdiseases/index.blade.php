@extends('admin.layout')
	@section('content')
		<div class="container-fluid">
			<div class="col-lg-12">
				<h3>Listado de Patologías y Diagnósticos</h3>
			
				<div class="col-lg-7">
					@include('backend.vdiseases.search_disease')
				</div>
				<div class="col-lg-5">
					<a href="{{ route('pathologic_lists.create') }}" class="btn btn-success btn-md pull-right">
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
					@if($list_diseases->total() > 0)
						<h4>Hay <span class="badge label label primary">{{ $list_diseases->total() }}</span> registros.</h4>
					@else
						<h4>Hay <span class="badge label label primary"> 0 </span> registros.</h4>
					@endif
				</div> <!-- Fin conteo-->
				
					<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
						<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
							<th>#</th>
							<th>Descripción</th>
							<th>Causa</th>
							<th>Sintoma #1</th>
							<th>Sintoma #2</th>
							<th>Sintoma #3</th>
							<th>Fecha de diagnóstico</th>							
							<th>Acciones</th>
						</thead>
						<tbody>
							@foreach($list_diseases as $disease)
								<tr>
									<td>{{ $disease->id_disease }}</td>
									<td>{{ $disease->description }}</td>
									<td>{{ $disease->cause }}</td>
									<td>{{ $disease->first_sintom }}</td>
									<td>{{ $disease->second_sintom }}</td>
									<td>{{ $disease->third_sintom }}</td>

									<td>{{ date('d/m/Y', strtotime( $disease->day_detected ) ) }}</td>
									{{-- <td>{{ date('d/m/Y', strtotime( $disease->updated_at ) ) }}</td> --}}
									<td>
										<form class="" action="{{route('pathologic_lists.destroy', $disease->id_disease )}}" method="post">
			                                <input type="hidden" name="_method" value="delete">
			                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                                <a href="{{route('pathologic_lists.edit', $disease->id_disease )}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>

			                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro');" name="delete">
			                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
			                                </button>
                            			</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $list_diseases->appends( Request::only('descripcion'))->render() }}
				</div>
			</div>
		</div><!-- /container-fluid -->
@stop