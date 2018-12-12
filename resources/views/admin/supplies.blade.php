@extends('layout')

@section('content')
<div class="modal fade" id="new-supply">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h3 class="modal-title">Ingresar nuevo Insumo</h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'ns', 'method' => 'post']) !!}
                	<div class="form-group">
                		{!! Form::label('code', 'Introduzca el c&oacute;digo del insumo') !!}
                		{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej: DESAN	']) !!}
                	</div>
                    <div class="form-group">
                        {!! Form::label('name', 'Introduzca el nombre del insumo') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el nombre del Insumo']) !!}
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
			<h2>Administrar <small>Insumos</small></h2>
			<div class="space"></div>
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>C&oacute;digo</th>
							<th>Nombre</th>
							<th>Cantidad Anodizado</th>
							<th>Cantidad Pintura</th>
							<th>Acci&oacute;n</th>
						</tr>
						@foreach($supplies as $supply)
						<tr>
							{!! Form::model($supply, ['route' => ['edSup', session('process')], 'method' => 'post']) !!}
								{!! Form::hidden('id', null) !!}
								<td>{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el c&oacute;digo del insumo']) !!}</td>
								<td>{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el nombre del insumo']) !!}</td>
								<td>{!! Form::number('aQuantity', null, ['class' => 'form-control', 'placeholder' => 'Introduza la cantidad existente']) !!}</td>
								<td>{!! Form::number('pQuantity', null, ['class' => 'form-control', 'placeholder' => 'Introduza la cantidad existente']) !!}</td>
								<td><button class="btn btn-warning form-control" type="submit">Editar</button></td>
							{!! Form::close() !!}
						</tr>
						@endforeach
					</table>
					<a href="#new-supply" type="button" class="btn btn-link" data-toggle="modal">Agregar Insumo</a>
				</div>
				{!! $supplies->render() !!}
			</div>
		</div>
	</div>
</div>
@stop