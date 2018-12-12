@extends('layout')

@section('content')
<div class="modal fade" id="new-color">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Agregar nuevo color</h3>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'newColor', 'method' => 'post']) !!}
					<div class="form-group">
						{!! Form::label('code', 'Introduce el codigo del color') !!}
						{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej: BLM']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('name', 'Introduce el nombre del color') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej: Blanco Mate']) !!}
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Guardar</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Acci&oacute;n</th>
				</tr>
				@foreach($colors as $color)
					<tr>
						{!! Form::model($color, ['route' => ['edColor', session('process'), $color->id], 'method' => 'post']) !!}
							<td>{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej: BLM']) !!}</td>
							<td>{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej: Blanco Mate']) !!}</td>
							<td><button type="submit" class="btn btn-warning form-control">Editar</button></td>
						{!! Form::close() !!}
					</tr>
				@endforeach
			</table>
			<a href="#new-color" type="button" class="btn btn-link" data-toggle="modal">Agregar color</a>
		</div>
	</div>
</div>
@stop