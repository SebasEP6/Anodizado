@extends('layout')

@section('styles')
<!-- Datepicker Files -->
<link rel="stylesheet" href="{{asset('css/bootstrap-datepicker3.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-standalone.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="content">
        <div class="col-md-4 col-md-offset-4">
            {!! Form::open(['route' => ['repo', $process], 'method' => 'post']) !!}
                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group">
                        <input type="datepicker" class="form-control datepicker" name="date">
                    </div>
                </div>
                <button type="submit" class="btn btn-default btn-warning">Enviar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<!-- Languaje -->
<script src="{{asset('locales/bootstrap-datepicker.es.min.js')}}"></script>
<script>
    $(".datepicker").datepicker( {
	    format: "mm-yyyy",
	    startView: "months",
	    language: "es",
	    minViewMode: "months",
        startDate: new Date(2016, 0, 1),
        endDate: "now"
	});
</script>
@endsection