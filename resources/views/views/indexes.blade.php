@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Indices <small>Insumos</small></h2>
		</div>
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open(['route' => ['index', session('process'), 1], 'method' => 'post']) !!}
				<div class="form-group">
					{!! Form::label('supplies', 'Seleccione el insumo a verificar') !!}
					{!! Form::select('supplies', $supplies, null, ['class' => 'form-control', 'placeholder' => 'Insumo']) !!}
				</div>
				<div class="form-group">
					<button class="btn btn-warning pull-right" type="submit">Ver</button>
				</div>
			{!! Form::close() !!}
		</div>
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
	</div>
	@if ($i != null)
	<div class="space"></div>
	<div class="row">
		<div class="col-md-12">
			<div id="container" style="min-width: 300px; height: 400px; margin:0 auto"></div>
		</div>
	</div>
	@endif
</div>
@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
@if ($i != null)
<script type="text/javascript">
	$(function () {
    $('#container').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Indices, {{ $data["name"] }}'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Fechas'
            }
        },
        yAxis: {
            title: {
                text: 'Uso (%)'
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} %'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },

        series: [{
            name: '{{ $data["name"] }}',
            // Define the data points. All series have a dummy year
            // of 1970/71 in order to be compared on the same x axis. Note
            // that in JavaScript, months start at 0 for January, 1 for February etc.
            data: [
                @foreach($data['attributes'] as $index)
                [Date.UTC({{ $index['year'] }}, {{ $index['month'] - 1 }}, {{ $index['day'] }}), {{ $index['index'] }}],
                @endforeach
            ]
        }]
    });
});
</script>
@endif
@endsection