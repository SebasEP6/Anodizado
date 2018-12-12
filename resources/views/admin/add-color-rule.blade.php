@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Insumo</th>
					<th>Seleccione su uso</th>
				</tr>
				{!! Form::open(['route' => ['newCRule', $i], 'method' => 'post']) !!}
					@foreach($supplies as $supply)
						<tr>
							<td>
								{!! Form::label('material', $supply->name, ['class' => 'form-control']) !!}
							</td>
							<td><div class="form-group">
								{!! Form::select($supply->id, [0 => 'No aplica', 1 => 'Aplica'], null, ['class' => 'form-control']) !!}
							</div></td>
						</tr>
					@endforeach
					<tr>
						<td colspan="100%"><button type="submit" class="btn btn-warning form-control">Guardar</button></td>
					</tr>
				{!! Form::close() !!}
			</table>
		</div>
	</div>
</div>
@stop