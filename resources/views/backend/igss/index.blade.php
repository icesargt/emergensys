@extends('admin.layout')
@section('content')

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="container">
			<div class="col-md-12">
				
			</div>
		</div>
		<!-- Tabla responsiva-->
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped table-condensed">
	  			<thead>
				    <tr>
				      <th>#</th>
				      <th>Año</th>
				      <th>Cuota Igss</th>
				      <th>Fecha de alta</th>
				      <th>Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($igss_quota as $igss)
					    <tr>
					      <th>{{ $igss->id_igss }}</th>
					      <td>{{ $igss->year }}</td>
					      <td>{{ $igss->quota }}</td>
					      <td>{{ $igss->created_at }}</td>
					      <td>Actions</td>
					    </tr>
				    @endforeach	    
				  </tbody>
			</table>
			{{ $igss_cuota->appends($$igss->year)->render()}}
		</div>
	</div>
</div>
@stop