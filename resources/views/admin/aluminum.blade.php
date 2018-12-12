@extends('layout')

@section('content')
<div class="modal fade" id="new-alItem">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h3 class="modal-title">Ingresar nuevo perfil</h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'np', 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('code', 'Introduzca el c&oacute;digo del perfil') !!}
                        {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej: VCRA']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Introduzca el nombre del perfil') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej: Lateral Liso']) !!}
                    </div>
                    <div class="form_group">
                    	{!! Form::label('area', 'Introduzca el area del perfil') !!}
                    	{!! Form::number('area', null, ['class' => 'form-control', 'placeholder' => 'Ej: 1.111']) !!}
                    </div>
                    <div class="form_group">
                    	{!! Form::label('weight', 'Introduzca el peso del perfil') !!}
                    	{!! Form::number('weight', null, ['class' => 'form-control', 'placeholder' => 'Ej: 3.333']) !!}
                    </div>
                    <div class="form-group">
                    	{!! Form::label('group', 'Seleccione el grupo del perfil') !!}
                    	{!! Form::select('group', $groups, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form_group">
                    	{!! Form::label('pGroup', 'Introduzca la cantidad de perfiles por bastidor (Pintura)') !!}
                    	{!! Form::number('pGroup', null, ['class' => 'form-control', 'placeholder' => 'Ej: 15']) !!}
                    </div>
                    <div class="form_group">
                    	{!! Form::label('aGroup', 'Introduzca la cantidad de perfiles por bastidor (Anodizado)') !!}
                    	{!! Form::number('aGroup', null, ['class' => 'form-control', 'placeholder' => 'Ej: 15']) !!}
                    </div>
                    <div class="space"></div>
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
			<h2>Administrar <small>Perfiles</small></h2>
			<div class="space"></div>
			<div class="panel panel-default table-responsive">
				<div class="panel-body">
					<table class="table table-striped table-bordered">
                        <tr>
                            <th>C&oacute;digo</th>
                            <th>Nombre</th>
                            <th>Grupo</th>
                            <th>&Aacute;rea</th>
                            <th>Peso</th>
                            <th>Pieza/Bastidor(Pintura)</th>
                            <th>Pieza/Bastidor(Anodizado)</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                        @foreach($aluminum as $piece)
                        <tr>
                            {!! Form::model($piece, ['route' => ['edAlum', session('process')], 'method' => 'post']) !!}
                                {!! Form::hidden('id', null) !!}
                                <td>{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Intrpduzca el c&oacute;digo']) !!}</td>
                                <td>{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el nombre de perfil']) !!}</td>
                                <td>{!! Form::select('group_id', $groups, null, ['class' => 'form-control']) !!}</td>
                                <td>{!! Form::number('area', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el area del perfil']) !!}</td>
                                <td>{!! Form::number('weight', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el peso del perfil']) !!}</td>
                                <td>{!! Form::number('pGroup', null, ['class' => 'form-control']) !!}</td>
                                <td>{!! Form::number('aGroup', null, ['class' => 'form-control'])!!}</td>
                                <td><button class="btn btn-warning form-control" type="submit">Editar</button></td>
                            {!! Form::close() !!}
                        </tr>
                        @endforeach
                    </table>
                    <a href="#new-alItem" type="button" class="btn btn-link" data-toggle="modal">Agregar perfil</a>
				</div>
                {!! $aluminum->render() !!}
			</div>
		</div>
	</div>
</div>
@stop