@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Lista Motocykli</h1>
            @guest
            @else 
            @if(Auth::user()->auth == '3' OR Auth::user()->auth == '2')
                &nbsp <a href="/moto/dodaj" class="btn btn-primary"> Dodaj</a>
            @endif
            @endguest

            <form method="post" action="{{ url('/moto/search') }}">
                <input type="text" name="szukaj" placeholder="Szukaj..">
                <input type="hidden" name="_token" value=" {{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">Wyszukaj</button> 
            </form>
            
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

        		
                <table class="table table-striped table-bordered" style="width: 90%; ">
        			<thead>

        				<tr class="info">
        					@guest
        					<th>Motocykle</th>
        					<th>Opis</th>
        					@else
        					<th>Motocykle</th>
        					<th>Opis</th>
        					@if(Auth::user()->auth == '3' OR Auth::user()->auth == '2' OR Auth::user()->auth == '1')
        					<th>Akcje</th>
        					@endif
        					@endguest
        					
        				</tr>
        			</thead>

        			<tbody>
        				@foreach ($moto as $motor)
        				<tr>
							<td style="max-height: 200px; width: 200px;"><img src="/{{$motor->zdj}}" style="max-height: 200px; max-width: 200px; "></td>
                            <td>
                            	<p><b>{{$motor->marka}} {{$motor->model}}</b></p>
								<p>Pojemnośc: {{$motor->pojemnosc}} cm3</p>
								<p>Moc: {{$motor->moc}} KM</p>
								<p>Waga: {{$motor->waga}} kg</p>
										<p>Dostępność: 
												@if( $motor->dostep == '1' )
													Dostępny
												@endif
												@if( $motor->dostep == '0' )
													Niedostępny
												@endif
								</p>
                                
                            </td>
                            @guest
							@else
							<td style="width: 50px;">
							@if(Auth::user()->auth == '3' OR Auth::user()->auth == '2')
								<a href="{{ url('/moto/edit/'. $motor->id) }}" class="btn btn-primary"> Edytuj</a><br><br>
								<a href="{{ url('/moto/delete/'. $motor->id) }}" class="btn btn-primary"> Usuń</a>
							</td>
                            @endif
                            @if(Auth::user()->auth == '1' AND $motor->dostep == '1')
                                <a href="{{ url('/moto/loan/'. $motor->id) }}" class="btn btn-primary"> Wypożycz</a><br><br>
                            </td>
                            @endif
                            @endguest
        				</tr>
        				@endforeach
        			</tbody>
        		</table>
        </div>

@endsection