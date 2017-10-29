@extends('admin.layout')
@section('content')

<div class="container-fluid">
	<div class="col-lg-12">			
		<h3>Lista de cuotas Igss</h3>							
		<div class="col-lg-6">
			@include('backend.salary._search_salary')				
		</div>

		<div class="col-lg-6">
			<a href="{{route('cuotas.create')}}" class="btn btn-success btn-md pull-right"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva cuota</a>
		</div>
		<hr>
	</div>

	<div class="col-lg-12">
		<hr>
	</div>

		<!-- Tabla responsiva-->
		
	<div class="col-lg-12"> <!-- style="border: 1px solid #333333;" -->
		<div class="table-responsive">
		<div class="col-lg-2">
			@if($igss_quota->total()>0)
				<h4>Hay <span class="badge label label-primary">{{ $igss_quota->total() }}</span> cuotas.</h4>
			@else
				<h4>Hay <span class="badge label label-default">{{ $igss_quota->total() }}</span> cuotas.</h4>
			@endif			
		</div>			
			<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
	  			<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
				    <tr>
				      <th>#</th>
				      <th>Año</th>
				      <th>Cuota Igss</th>
				      <th>Fecha de alta</th>
				      <th>Acciones</th>
				    </tr>
				  </thead>
				  <tbody>				  		
					  	@forelse($igss_quota as $igss)
					  		<tr>
							      <td>{{ $igss->id_igss }}</td>
							      <td>{{ $igss->year }}</td>
							      <td>{{ $igss->quota }}</td>
							      <td>{{ $igss->created_at }}</td>
							      <td>
							      	<form class="" action="{{route('cuotas.destroy',$igss->id_igss)}}" method="post">
		                                <input type="hidden" name="_method" value="delete">
		                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                                <a href="{{route('cuotas.edit',$igss->id_igss)}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>

		                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro');" name="delete">
		                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
		                                </button>
                            </form>
							      </td>
							</tr>
					  	@empty
					  		
					  	@endforelse				  	
				  </tbody>
			</table>
			<hr>
			{{$igss_quota->appends(Request::only([ 'cuota' ]))->render()}}
		</div>
	</div>
</div>
@stop