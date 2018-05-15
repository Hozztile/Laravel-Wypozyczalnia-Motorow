@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Lista Motocykli</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@if ($moto->count() > 0 )
        		
                <table class="table table-striped table-bordered" style="width: 90%; ">
        			<thead>

        				<tr class="info">
        					@guest
        					<th>Motocykle</th>
        					<th>Opis</th>
        					@else
        					<th>Motocykle</th>
        					<th>Opis</th>
        					@if(Auth::user()->auth == '3' OR Auth::user()->auth == '2')
        					<th>Akcje</th>
        					@endif
        					@endguest
        					
        				</tr>
        			</thead>

        			<tbody>
        				@foreach ($moto as $motor)
        				<tr>
							<td style="max-height: 200px; width: 200px;"><img src="{{$motor->zdj}}" style="max-height: 200px; max-width: 200px; "></td>
                            <td>
                            	<p><b>{{$motor->marka}} {{$motor->model}}</b></p>
								<p>Pojemnośc: {{$motor->pojemnosc}}</p>
								<p>Moc: {{$motor->moc}}</p>
								<p>Waga: {{$motor->waga}}</p>
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
                            @endguest
        				</tr>
        				@endforeach
        			</tbody>
        		</table>
        		@endif
        </div>

@endsection