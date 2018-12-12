@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Insumo</th>
					<th>Color</th>
					<th>Uso</th>
					<th>Acci&oacute;n</th>
				</tr>
				@foreach($rules as $rule)
				{!! Form::model($rule, ['route' => ['chngRule', $rule->material_id], 'method' => 'post']) !!}
				<input type="hidden" name="id" value="{{ $rule->id }}">
				<tr>
					<td>{{ $rule->material->name }}</td>
					<td>{{ $rule->color->name }}</td>
					<td>{!! Form::select('value', [0 => 'No aplica', 1 => 'Aplica'], null, ['class' => 'form-control']) !!}</td>
					<td><button type="submit" class="btn btn-warning form-control">Guardar</button></td>
				</tr>
				{!! Form::close() !!}
				@endforeach
			</table>
		</div>
	</div>
</div>
@stop