@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<h2>Transferir <small>Insumos</small></h2>
		<div class="col-md-8 col-md-offset-2">
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
			<div class="panel panel-default">
				<div class="panel-body">
					{!! Form::open(['route' => 'transfer', 'method' => 'post']) !!}
						<div class="form-group">
							{!! Form::label('id', 'Seleccione el nombre del insumo') !!}
							<input list="supplies" name="id" class="form-control" placeholder="Ej: Desengrase">
							<datalist id="supplies">
								@foreach($supplies as $supply)
								<option value="{{ $supply->id }}">{{ $supply->name }}</option>
								@endforeach
							</datalist>
						</div>
						<div class="form-group">
							{!! Form::label('quantity', 'Introduzca la cantidad a transferir') !!}
							{!! Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => 'Ej: 15']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('transfer', 'Seleccione hacia donde se transferira el insumo') !!}
							{!! Form::select('transfer', ['anodizado' => 'Anodizado', 'pintura' => 'Pintura'], null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							<button class="btn btn-warning pull-right" type="submit">Transferir</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection