@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Insumo</th>
					@foreach($colors as $color)
					<th>{{ $color->code }}</th>
					@endforeach
					<th>Acci&oacute;n</th>
				</tr>
				@foreach($rules as $rule)
				<tr>
					<td>{{ $rule['material'] }}</td>
					@foreach($colors as $color)
						@if ($rule[$color->id] == 1)
						<td>Aplica</td>
						@else
						<td>No Aplica</td>
						@endif
					@endforeach
					<td><a class="btn btn-warning form-control" href="{{ route('chngRule', $rule['id']) }}">Editar</a></td>
				</tr>
				@endforeach()
			</table>
		</div>
	</div>
</div>
@stop