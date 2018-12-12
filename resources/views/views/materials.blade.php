@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Inventario <small>Insumos</small></h2>
		</div>
		<div class="col-md-6 col-md-offset-3">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
						<th>C&oacute;digo</th>
						<th>Nombre</th>
						<th>Cantidad</th>
					</tr>
					@foreach($materials as $material)
					<tr>
						<td>{{ $material->code }}</td>
						<td>{{ $material->name }}</td>
						@if ($process == 'anodizado')
						<td>{{ $material->aQuantity }}</td>
						@else
						<td>{{ $material->pQuantity }}</td>
						@endif
					</tr>
					@endforeach
				</table>
			</div>
			{!! $materials->render() !!}
		</div>
	</div>
</div>
@stop