@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3>Formulario de Ingreso</h3>
				</div>
				<div class="panel-body">
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
					{!! Form::open(['route' => 'login', 'method' => 'post']) !!}
						<div class="form-group">
							{!! Form::label('email', 'Ingresa tu correo', ['class' => 'sr-only']) !!}
							{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingresa tu correo']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('password', 'Ingresa tu clave', ['class' => 'sr-only']) !!}
							{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingresa tu clave']) !!}
						</div>
						<button type="submit" class="btn btn-warning pull-right">Ingresar</button>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop