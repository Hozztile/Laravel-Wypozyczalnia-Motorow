@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Wypożycz {{$moto->marka['nazwa']}} {{$moto->model}}</h1><br><br>
		</div>
	</div>

	@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif

	<div class="row">
		<div class="col-md-12">
			<form class="form" method="POST" action="{{ url('moto/do-loan') }}" >
				<div style=" display: inline-block;">
				<input type="hidden" name="_token" value=" {{ csrf_token() }}">
				<input type="hidden" name="id_moto" value="{{ $moto->id }}">
				Data od:<input type="date" name="data_od" min="2018-06-04" required><br><br>
				Data do:<input type="date" name="data_do" min="2018-06-04" required><br><br><br>
				Miejsce odbioru:<input type="text" name="lok_z" required><br><br>
				Miejsce zdania:<input type="text" name="lok_do" required><br><br>
				</div>
				<div style="float: right; display: inline-block; margin-right: 500px;">
					<h3>Dodatki:</h3>
				@foreach($eq as $dodatek)
					<input type="checkbox" name="check_list_dodatki[]" value="{{ $dodatek->id }}">{{ $dodatek->nazwa }}<br>
				@endforeach
				</div>
				<br>
				<input type="submit" name="submit" class="btn btn_primary">
			
		</form>
		</div>
	</div>



@endsection