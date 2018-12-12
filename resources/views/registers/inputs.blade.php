@extends('layout')

@section('content')
<div class="modal fade" id="new-client">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h3 class="modal-title">Ingresar nuevo cliente</h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'nc', 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Introduzca el nombre del cliente', ['class' => 'sr-only']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el nombre del cliente']) !!}
                    </div>
                    <div class="form-group">
                    	<button class="btn btn-warning" type="submit">Agregar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Movimientos <small>{{ trans('utils.move.'.$type) }}</small></h2>
			<div class="space"></div>
			@if($i != null)
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Perfil</th>
						<th>Grupo</th>
						<th>Color de ingreso</th>
						<th>Color deseado</th>
						<th>Cantidad</th>
						<th>Cliente</th>
					</tr>
					@foreach($items as $item)
					<tr>
						<td>{{ $item->alItem->name }}</td>
						<td>{{ $item->alItem->group->name }}</td>
						<td>{{ $item->colorI->name }}</td>
						<td>{{ $item->colorO->name }}</td>
						<td>{{ $item->quantity }}</td>
						<td>{{ $item->client->name }}</td>
					</tr>
					@endforeach
				</table>
			</div>
			<a href="{{ route('put', [session('process'), $type]) }}" class="btn btn-warning pull-right">Finalizar</a>
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
			<div class="space"></div>
			@endif
			<div class="form">
				<a href="#form-put" class="btn btn-warning" data-toggle="collapse">Mostrar formulario</a>
				<div class="space"></div>
				<div class="collapse" id="form-put">
					<div class="well">
						{!! Form::open(['route' => ['regPut', session('process'), $type, $i], 'method' => 'post']) !!}
							<div class="form-group">
								{!! Form::label('aluminum', 'Seleccione la pieza') !!}
								<select name="aluminum" id="aluminum" class="form-control">
									@foreach($aluminum as $piece)
									<option value="{{ $piece->id }}">{{ $piece->group->name . ': ' . $piece->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								{!! Form::label('quantity', 'Introduzca la cantidad de piezas') !!}
								{!! Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => 'Introduzca la cantidad de piezas']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('colorI', 'Seleccione el color de la pieza') !!}
								{!! Form::select('colorI', $colors, null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('colorO', 'Seleccione el color deseado') !!}
								{!! Form::select('colorO', $colors, null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('client', 'Seleccione el cliente') !!}
								<select name="client" id="client" class="form-control">
									@foreach($clients as $client)
									<option value="{{ $client->id }}">{{ $client->name }}</option>
									@endforeach
								</select>
								<a href="#new-client" type="button" class="btn btn-link" data-toggle="modal">Agregar cliente</a>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-warning pull-right">Agregar item</button>
								<div class="space"></div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop