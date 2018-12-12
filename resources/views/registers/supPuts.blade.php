@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Nota de insumos <small>{{ trans('utils.consume.'.$type) }}</small></h2>
			<div class="space"></div>

			@if($i != null)
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Insumo</th>
						<th>Cantidad</th>
					</tr>
					@foreach($items as $item)
					<tr>
						<td>{{ $item->matItem->name }}</td>
						<td>{{ $item->quantity }}</td>
					</tr>
					@endforeach
				</table>
			</div>
			<a href="{{ route('sn', session('process')) }}" class="btn btn-warning pull-right">Finalizar</a>
			<div class="space"></div>
			@endif

			@if (count($errors) > 0)
			<div class="space"></div>
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
				<a href="#form-regCons" class="btn btn-warning" data-toggle="collapse">Mostrar items</a>
				<div class="space"></div>
				<div class="collapse" id="form-regCons">
					<div class="well">
						<table class="table table-striped table-bordered">
							<tr>
								<th>Insumo</th>
								<th>Cantidad</th>
								<th>Acci&oacute;n</th>
							</tr>
							@foreach($supplies as $item)
								{!!  Form::model($item, ['route' => ['regSup', session('process'), $type, $i], 'method' => 'post'])  !!}
									<tr>
										<input type="hidden" name="item_id" value="{{ $item->id }}">
										<td>{{{ $item->name }}}</td>
										@if($type == 'input')
										<td>
											{!! Form::number('quantity', 0, ['class' => 'form-control']) !!}
										</td>
										<td>
											<button type="submit" class="btn btn-warning form-control">Agregar</button>
										</td>
										@else
											@if(session('process') == 'anodizado')
											<td>
												{!! Form::number('aQuantity', null, ['class' => 'form-control']) !!}
											</td>
											<td>
												@if($item->aQuantity > 0)
												<button type="submit" class="btn btn-warning form-control">Agregar</button>
												@else
												<button type="submit" class="btn btn-danger form-control disabled">Agregar</button>
												@endif
											</td>
											@else
											<td>
												{!! Form::number('pQuantity', null, ['class' => 'form-control']) !!}
											</td>
											<td>
												@if($item->pQuantity > 0)
												<button type="submit" class="btn btn-warning form-control">Agregar</button>
												@else
												<button type="submit" class="btn btn-danger form-control disabled">Agregar</button>
												@endif
											</td>
											@endif
										@endif
									</tr>
								{!! Form::close() !!}
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop