@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Dodaj motocykl</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form class="form" method="POST" action="{{ url('moto/do_dodaj') }}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value=" {{ csrf_token() }}">

				Marka: <input type="marka" name="marka" required><br><br>
				Model: <input type="model" name="model" required><br><br>
				Pojemość: <input type="pojemnosc" name="pojemnosc" required><br><br>
				Moc: <input type="moc" name="moc" required><br><br>
				Waga: <input type="waga" name="waga" required><br><br>
				Wybierz zdjęcie: <input type="file" name="file" id="file" required><br><br>

			<a href="{{ url('/moto/list')}}" alt='zdjęcie' class="btn btn-primary">Wróć</a>
			<button class="btn btn_primary">Stwórz</button>
		</form>
		</div>
	</div>

@endsection