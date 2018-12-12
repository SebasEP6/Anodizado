@extends('layout')

@section('content')
<div class="modal fade" id="new-group">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Agregar nuevo grupo</h3>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'newGroup', 'method' => 'post']) !!}
					<div class="form-group">
						{!! Form::label('code', 'Introduce el codigo del grupo') !!}
						{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej: VC']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('name', 'Introduce el nombre del grupo') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej: Ventana Corredera']) !!}
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
				@foreach($groups as $group)
					<tr>
						{!! Form::model($group, ['route' => ['edGroup', session('process'), $group->id], 'method' => 'post']) !!}
							<td>{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej: VC']) !!}</td>
							<td>{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej: Ventana Corredera']) !!}</td>
							<td><button type="submit" class="btn btn-warning form-control">Editar</button></td>
						{!! Form::close() !!}
					</tr>
				@endforeach
			</table>
			<a href="#new-group" type="button" class="btn btn-link" data-toggle="modal">Agregar grupo</a>
			{!! $groups->render() !!}
		</div>
	</div>
</div>
@stop