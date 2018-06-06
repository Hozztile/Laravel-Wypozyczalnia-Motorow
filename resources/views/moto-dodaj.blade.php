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

				Marka: <select name="marka">
					@foreach($moto as $marka)
						<option value="{{ $marka->id }}">{{ $marka->nazwa }}</option>
					@endforeach
					
				</select><br><br>
				Model: <input type="text" name="model" required><br><br>
				Pojemość: <input type="number" name="pojemnosc" required><br><br>
				Moc: <input type="number" name="moc" required><br><br>
				Waga: <input type="number" name="waga" required><br><br>
				Cena: <input type="number" name="cena" required><br><br>
				Przebieg: <input type="number" name="przebieg" required><br><br>
				Wybierz zdjęcie: <input type="file" name="file" id="file" required><br><br>

			<a href="{{ url('/moto/list')}}" alt='zdjęcie' class="btn btn-primary">Wróć</a>
			<button class="btn btn_primary">Dodaj</button>
		</form>
		</div>
	</div>

@endsection