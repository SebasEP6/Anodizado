@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Inventario <small>Perfiles</small></h2>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
						<th>C&oacute;digo</th>
						<th>Nombre</th>
						<th>Grupo</th>
						<th>&Aacute;rea</th>
						<th>Peso</th>
						<th>Pieza/Bastidor (Pintura)</th>
						<th>Pieza/Bastidor (Anodizado)</th>
						<th>Cantidad</th>
					</tr>
					@foreach($aluminum as $piece)
					<tr>
						<td>{{ $piece->code }}</td>
						<td>{{ $piece->name }}</td>
						<td>{{ $piece->group->name }}</td>
						<td>{{ $piece->area }}</td>
						<td>{{ $piece->weight }}</td>
						<td><div class="text-center">{{ $piece->pGroup }}</div></td>
						<td><div class="text-center">{{ $piece->aGroup }}</div></td>
						<td><div class="text-center">{{ $piece->quantity }}</div></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	{!! $aluminum->render() !!}
</div>
@stop