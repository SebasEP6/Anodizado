@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Registro de Orden <small>Producci&oacute;n</small></h2>
			<div class="space"></div>
			@if($i != null)
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Perfil</th>
						<th>Grupo</th>
						<th>Color</th>
						<th>Cantidad</th>
						<th>Cliente</th>
					</tr>
					@foreach($items as $item)
					<tr>
						<td>{{ $item->alItem->name  }}</td>
						<td>{{ $item->alItem->group->name }}</td>
						<td>{{ $item->color->name }}</td>
						<td>{{ $item->quantity }}</td>
						<td>{{ $item->client->name }}</td>
					</tr>
					@endforeach
				</table>
			</div>
			<a href="{{ route('pp', session('process')) }}" class="btn btn-warning pull-right">Finalizar</a>
			<div class="space"></div>
			@endif
			<div class="space"></div>
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Hey!</strong> Se encontraron algunos problemas.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form">
				<a href="#form-prodReg" class="btn btn-warning" data-toggle="collapse">Mostrar items</a>
				<div class="space"></div>
				<div class="collapse" id="form-prodReg">
					<div class="well">
						<table class="table table-striped table-bordered">
							<tr>
								<th>Perfil</th>
								<th>Grupo</th>
								<th>Cantidad</th>
								<th>Color</th>
								<th>Cliente</th>
								<th>Acci&oacute;n</th>
							</tr>
							@foreach($orders as $list)
								@foreach($list->productionList as $item)
									@if($item->quantity > 0)
									{!!  Form::model($item, ['route' => ['regPart', session('process'), $i], 'method' => 'post'])  !!}
										<tr>
											<input type="hidden" name="item_id" value="{{ $item->id }}">
											<td>{{{ $item->alItem->name }}}</td>
											<td>{{ $item->alItem->group->name }}</td>
											<td>{!! Form::number('quantity', null, ['class' => 'form-control']) !!}</td>
											<td>{{ $item->colorO->name }}</td>
											<td>{{ $item->client->name }}</td>
											<td>
											@if($item->quantity > 50)
											<button type="submit" class="btn btn-warning form-control">Agregar</button>
											@elseif($item->quantity > 0)
											<button type="submit" class="btn btn-danger form-control">Agregar</button>
											@else
											<button type="submit" class="btn btn-danger form-control disabled">Agregar</button>
											@endif
											</td>
										</tr>
									{!! Form::close() !!}
									@endif
								@endforeach
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop