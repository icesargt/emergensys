@extends('admin.layout')
@section('content')

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="container">
			<div class="col-md-12">
				@include('igss._search_igss')
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

			  	@forelse($igss_quota as $igss)
			  		<tr>
					      <th>{{ $igss->id_igss }}</th>
					      <td>{{ $igss->year }}</td>
					      <td>{{ $igss->quota }}</td>
					      <td>{{ $igss->created_at }}</td>
					      <td>Actions</td>
					</tr>
			  	@empty
			  		<p>No hay resultados.</p>
			  	@endforelse
				  	{{-- @foreach($igss_quota as $igss)
					    <tr>
					      <th>{{ $igss->id_igss }}</th>
					      <td>{{ $igss->year }}</td>
					      <td>{{ $igss->quota }}</td>
					      <td>{{ $igss->created_at }}</td>
					      <td>Actions</td>
					    </tr>
				    @endforeach --}}
				  </tbody>
			</table>
			{{ $igss_cuota->appends($igss->quota)->render()}}
		</div>
	</div>
</div>
@stop