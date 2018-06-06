@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Lista rezerwacji</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@if ($wypo->count() > 0 )
        		
                <table class="table table-striped table-bordered" style="width: 90%; ">
        			<thead>

        				<tr class="info">
                            <th>Użytkownik</th>
                            <th>Motocykl</th>
                            <th>Dodatki</th>
                            <th>Data początku rezerwacji</th>
                            <th>Data końca rezerwacji</th>
                            <th>Miejsce odboiru</th>
                            <th>Miejsce zdania</th>
                            <th>Cena(zł)</th>
                            <th>Akcje</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($wypo as $wypoz)
                        @if ($wypoz->aktywne == '1')
                        <tr>
                            <td>
                                {{ $wypoz->users->name }}
                                    
                            </td>
                            <td>
                                {{ $wypoz->moto->marka['nazwa'] }} {{ $wypoz->moto['model'] }}  o numerze identyfikacyjnym: {{ $wypoz->id_moto }}
                                    
                            </td>
                            <td>
                                @foreach ($wypoz->wypo_akcesoria as $akc)
                                    {{ $akc->akcesoria['nazwa']}}<br>
                                @endforeach
                            </td>
                            <td>
                                {{ $wypoz->wypo_od }}
                            </td>
                            <td>
                                {{ $wypoz->wypo_do }}
                            </td>
                            <td>
                                {{ $wypoz->lok_z}}
                            </td>
                            <td>
                                {{ $wypoz->lok_do }}
                            </td>
                            <td>
                                {{ $wypoz->cena_c }}
                            </td>
                            <td>
                                @if($wypoz->wypo_od >= '2018-06-04')
                                <a href="{{ url('/wypo/res/'. $wypoz->id) }}" class="btn btn_primary"> Anuluj</a>
                                @endif
                            </td>
                        </tr>
                        @endif
        				@endforeach
        			</tbody>
        		</table>
        		@endif
        </div>

@endsection