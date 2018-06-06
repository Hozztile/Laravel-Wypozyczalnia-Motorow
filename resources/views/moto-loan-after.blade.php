@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Sukces !</h1><br><br>
		</div>
	</div>

	

	<div class="row">
		<div class="col-md-12">
			Pobierz poniższe pliki w celu potwierdzenia rezerwacji na miejscu odboiru.<br><br>

			<a href="/dokumenty/KLAUZULA.pdf">Klauzula dotycząca ochrony danych osobowych</a><br>
			<a href="/dokumenty/POSTANOWIENIA.pdf">Postanowienia</a><br>
			<a href="/dokumenty/UMOWA.pdf">Umowa najmu motocykla</a><br>
			<a href="/dokumenty/REGULAMIN.pdf">Regulamin</a><br>

			<a href="{{ url('/user/list')}}" class="btn btn-primary">Wróć</a>
		</div>
	</div>



@endsection