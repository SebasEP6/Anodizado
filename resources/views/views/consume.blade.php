@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Movimientos <small>Insumos</small></h2>
		</div>
		<div class="col-md-5 col-md-offset-3">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Fecha</th>
						<th>Nombre</th>
						<th>Entrada</th>
						<th>Salida</th>
					</tr>
					@foreach($lists as $supply)
						@if($supply->consume->process == $process)
							@if($supply->consume->type == 'input')
							<tr>
								<td>{{ $supply->consume->created_at }}</td>
								<td>{{ $supply->matItem->name }}</td>
								<td><div class="text-center">{{ $supply->quantity }}</div></td>
								<td><div class="text-center"><p>X</p></div></td>
							</tr>
							@else
							<tr>
								<td>{{ $supply->consume->created_at }}</td>
								<td>{{ $supply->matItem->name }}</td>
								<td><div class="text-center"><p>X</p></div></td>
								<td><div class="text-center">{{ $supply->quantity }}</div></td>
							</tr>
							@endif
						@endif
					@endforeach
				</table>
			</div>
			{!! $lists->render() !!}
		</div>
	</div>
</div>
@stop