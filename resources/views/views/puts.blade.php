@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Movimientos <small>{{ trans('utils.move.'.$type) }}</small></h2>
		</div>
		<div class="col-md-6 col-md-offset-3">
			@foreach($moves as $move)
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="panel-title">
						<a href="#{{ $move->id }}" data-toggle="collapse">
							{{ $move->created_at }}
						</a>
					</div>
				</div>
				<div class="panel-collapse collapse" id="{{ $move->id }}">
					<ul class="list-group">
						<li class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>Perfil</th>
									<th>Grupo</th>
									<th>Color ingreso</th>
									<th>Color final</th>
									<th>Cantidad</th>
									<th>Cliente</th>
								</tr>
								@foreach($move->putsList as $item)
								<tr>
									<td>{{ $item->alItem->name }}</td>
									<td>{{ $item->alItem->group->name }}</td>
									@if($type == 'input')
									<td>{{ $item->colorI->name }}</td>
									@else
									<td><div class="text-center">X</div></td>
									@endif
									<td>{{ $item->colorO->name }}</td>
									<td>{{ $item->quantity }}</td>
									<td>{{ $item->client->name }}</td>
								</tr>
								@endforeach
							</table>
						</li>
					</ul>
				</div>
			</div>
			@endforeach
			{!! $moves->render() !!}
		</div>
	</div>
</div>
@stop