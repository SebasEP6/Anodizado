@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Ordenes <small>Producci&oacute;n</small></h2>
		</div>
		<div class="col-md-6 col-md-offset-3">
			@foreach($orders as $order)
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="panel-title">
						<a href="#{{ $order->id }}" data-toggle="collapse">
							{{ $order->created_at }}
						</a>
					</div>
				</div>
				<div class="panel-collapse collapse" id="{{ $order->id }}">
					<ul class="list-group">
						<li class="table-responsive">
							<table class="table table-striped table-bordered">
								<tr>
									<th>Perfil</th>
									<th>Grupo</th>
									<th>Color ingreso</th>
									<th>Color final</th>
									<th>Cantidad</th>
									<th>Pieza/Bastidor</th>
									<th>Cliente</th>
								</tr>
								@foreach($order->productionList as $item)
								<tr>
									<td>{{ $item->alItem->name }}</td>
									<td>{{ $item->alItem->group->name }}</td>
									<td>{{ $item->colorI->name }}</td>
									<td>{{ $item->colorO->name }}</td>
									<td>{{ $item->quantity }}</td>
									<td>{{ $item->group }}</td>
									<td>{{ $item->client->name }}</td>
								</tr>
								@endforeach
							</table>
						</li>
					</ul>
				</div>
			</div>
			@endforeach
			{!! $orders->render() !!}
		</div>
	</div>
</div>
@stop