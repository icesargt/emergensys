@extends('admin.layout')
@section('content')

<div class="container-fluid">
	<div class="col-lg-12">			
		<h3>Lista de Salarios Ordinarios</h3>							
		<div class="col-lg-6">
			@include('backend.salary._search_salary')
		</div>

		<div class="col-lg-6">
			<a href="{{route('salarios.create')}}" class="btn btn-success btn-md pull-right"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Salario</a>
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
			@if($salary_list->total()>0)
				<h4>Hay <span class="badge label label-primary">{{ $salary_list->total() }}</span> salarios.</h4>
			@else
				<h4>Hay <span class="badge label label-default">{{ $salary_list->total() }}</span> salarios.</h4>
			@endif
			
		</div>			
			<table class="table table-bordered table-hover table-striped table-condensed" style="background-color: rgba(75, 100, 111,0.10);">
	  			<thead style="background-color: rgba(75, 100, 111, 1); color: #FFF;">
				    <tr>
				      <th>#</th>
				      <th>Año</th>
				      <th>Salario Ordinario</th>
				      <th>Fecha de alta</th>
				      <th>Acciones</th>
				    </tr>
				  </thead>
				  <tbody>				  		
					  	@foreach($salary_list as $salary)
					  		<tr>
							      <td>{{ $salary->id_salary }}</td>
							      <td>{{ $salary->year }}</td>
							      <td>{{ $salary->ordinary_salary }}</td>
							      <td>{{ $salary->created_at }}</td>
							      	<td>
								      	<form class="" action="{{route('salarios.destroy',$salary->id_salary)}}" method="post">
			                                <input type="hidden" name="_method" value="delete">
			                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                                <a href="{{route('salarios.edit',$salary->id_salary)}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>

			                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('¿Esta seguro de eliminar este registro');" name="delete">
			                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Eliminar
			                                </button>
	                            		</form>
							      	</td>
							</tr>
					  	@endforeach
				  </tbody>
			</table>
			<hr>
			{{$salary_list->appends(Request::only([ 'salario' ]))->render() }}
		</div>
	</div>
</div>
@stop