@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Edytuj dane konta</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form action=" {{ url('user/do-edit/'. $user->id) }}" method="post">
				Imię i nazwisko:
				<input type="text" name="name_edit" value="{{ $user->name }}" required><br><br>
				E-mail:
				<input type="email" name="email_edit" value="{{ $user->email }}" required><br><br>
				Numer telefonu:
				<input type="text" name="telefon_edit" size="9" maxlength="9" value="{{ $user->telefon }}" required><br><br>
				@if(Auth::user()->auth == '3')
				<select id="auth_edit" name="auth_edit" required>
					<option disabled value="" selected>Poziom uprawnień</option>
					<option value="1">Klient</option>
					<option value="2">Pracownik</option>
				</select><br><br>
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id_users" value="{{ $user->id }}">
				<a href="{{ url('/user/list')}}" class="btn btn-primary">Wróć</a>
				<input type="submit" name="submit" class="btn btn_primary" value="Zapisz">
		</div>
	</div>

@endsection