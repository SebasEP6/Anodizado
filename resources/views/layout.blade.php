<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Anodizado Larense</title>
		@yield('styles')
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	</head>
	<body>
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="page-header">
							<h1>Anodizado Larense <small>Sistema de inventario</small></h1>
						</div>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main">
								<span class="sr-only">Men&uacute;</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown">
								{{ ucfirst(session('process')) }}
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('chng', 'anodizado') }}">Anodizado</a></li>
								<li><a href="{{ route('chng', 'pintura') }}">Pintura</a></li>
							</ul>
						</div>
						<div class="collapse navbar-collapse" id="main">
							@if(!Auth::guest())
							<ul class="nav navbar-nav pull-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										Ver
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li class="dropdown-header">Inventario</li>
										<li class="divider"></li>
										<li><a href="{{ route('mp', session('process')) }}">Insumos</a></li>
										<li><a href="{{ route('al', session('process')) }}">Perfiles</a></li>
										<li class="divider"></li>
										<li class="dropdown-header">Ordenes</li>
										<li class="divider"></li>
										<li><a href="{{ route('op', session('process')) }}">Producci&oacute;n</a></li>
										<li><a href="{{ route('pp', session('process')) }}">Parciales</a></li>
										<li class="divider"></li>
										<li class="dropdown-header">Movimientos</li>
										<li class="divider"></li>
										<li><a href="{{ route('put', [session('process'), 'input']) }}">Recepci&oacute;n</a></li>
										<li><a href="{{ route('put', [session('process'), 'output']) }}">Despacho</a></li>
										<li><a href="{{ route('sn', session('process')) }}">Insumos</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										Registro
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li class="dropdown-header">Insumos</li>
										<li class="divider"></li>
										<li><a href="{{ route('regSup', [session('process'), 'input']) }}">Entrada</a></li>
										<li><a href="{{ route('regSup', [session('process'), 'output']) }}">Consumo</a></li>
										<li><a href="{{ route('transfer', session('process')) }}">Transferencia</a></li>
										<li class="divider"></li>
										<li class="dropdown-header">Ordenes</li>
										<li class="divider"></li>
										<li><a href="{{ route('ro', session('process')) }}">Producci&oacute;n</a></li>
										<li><a href="{{ route('regPart', session('process')) }}">Parciales</a></li>
										<li class="divider"></li>
										<li class="dropdown-header">Movimientos</li>
										<li class="divider"></li>
										<li><a href="{{ route('regPut', [session('process'), 'input']) }}">Recepci&oacute;n</a></li>
										<li><a href="{{ route('regPut', [session('process'), 'output']) }}">Despacho</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										Administrar
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li class="dropdown-header">Inventario</li>
										<li class="divider"></li>
										<li><a href="{{ route('edSup', session('process')) }}">Insumos</a></li>
										<li><a href="{{ route('edAlum', session('process')) }}">Perfiles</a></li>
										<li><a href="{{ route('edGroup', session('process')) }}">Grupos</a></li>
										<li><a href="{{ route('edColor', session('process')) }}">Colores</a></li>
										<li class="divider"></li>
										<li class="dropdown-header">Indices</li>
										<li class="divider"></li>
										<li><a href="{{ route('index', session('process')) }}">Ver</a></li>
										<li><a href="{{ route('rules') }}">Reglas</a></li>
										<li class="divider"></li>
										<li class="dropdown-header">Reportes</li>
										<li class="divider"></li>
										<li><a href="{{ route('repo', session('process')) }}">Generar</a></li>
									</ul>
								</li>
								<li><a href="{{ route('logout') }}">Salir</a></li>
							</ul>
							@endif
						</div>
					</div>
				</nav>
		</header>

		<section>
			@yield('content')
		</section>

		<div class="navbar-fixed-bottom">
			<div class="blank"></div>
			<footer>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<p>Todos los derechos reservados 2016. Desarrollado por <strong class="author">Sebasti&aacute;n Escalona</strong></p>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<script src="{{ asset('js/jquery.js') }}"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		@yield('scripts')
	</body>
</html>