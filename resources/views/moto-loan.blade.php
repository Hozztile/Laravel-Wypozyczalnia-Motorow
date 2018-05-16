@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Wypożycz {{$moto->marka}} {{$moto->model}}</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form class="form" method="POST" action="{{ url('moto/do-loan') }}" >
				<input type="hidden" name="_token" value=" {{ csrf_token() }}">
				<input type="hidden" name="id_moto" value="{{ $moto->id }}">
				od:<input type="date" name="data_od" min="2018-05-16"><br><br>
				do:<input type="date" name="data_do"><br><br>
				<input type="submit" name="submit" class="btn btn_primary">
			
		</form>
		</div>
	</div>

@endsection