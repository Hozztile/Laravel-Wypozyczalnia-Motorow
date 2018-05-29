@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Edytuj dane motocyklu</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form action=" {{ url('moto/do-edit/'. $moto->id) }}" method="post">
				Marka
				  <select name="marka_edit">
                    @foreach($marka as $markaa)
                        <option value="{{ $markaa->id }}" {{ $moto->id_marka == $markaa->id ? 'selected="selected"' : '' }}>{{ $markaa->nazwa }}</option>
                    @endforeach
                </select><br><br>
				Model
				<input type="text" name="model_edit" value="{{ $moto->model }}" required><br><br>
				Pojemność
				<input type="number" name="pojemnosc_edit" value="{{ $moto->pojemnosc }}" required><br><br>
				Moc
				<input type="number" name="moc_edit" value="{{ $moto->moc }}" required><br><br>
				Waga
				<input type="number" name="waga_edit" value="{{ $moto->waga }}" required><br><br>
				Dostęp
				<select type="text" name="dostep_edit" required>
					<option value="1"> Dostępny</option>
					<option value="0"> Niedostępny</option>
				</select><br><br>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id_moto" value="{{ $moto->id }}">
				<input type="submit" name="submit" class="btn btn_primary" value="Zapisz">
			</form>
			<br><br>

			<h1>Edytuj zdjęcie motocyklu</h1>
			<form action=" {{ url('moto/do-edit-zdj/'. $moto->id) }}" method="post" enctype="multipart/form-data">
				<img src="/{{$moto->zdj}}" style="max-height: 200px; max-width: 200px; "><br>

				Zdjęcie
				<input type="file" name="file" id="file"><br><br>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id_moto" value="{{ $moto->id }}">
				<input type="submit" name="submit" class="btn btn_primary" value="Zapisz zdjęcie">
			</form>
				

				<br>
				<a href="{{ url('/moto/list')}}" class="btn btn-primary">Wróć</a>
		</div>
	</div>

@endsection