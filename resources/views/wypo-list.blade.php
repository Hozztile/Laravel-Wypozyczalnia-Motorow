@extends('layouts.app')

@section('content')
<br>
	<div class="row">
		<div class="col-md-12">
			<h1>Lista Wypożyczeń</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@if ($wypo->count() > 0 )
        		
                <table class="table table-striped table-bordered" style="width: 90%; ">
        			<thead>

        				<tr class="info">
        					<th>Użytownik</th>
                            <th>Motocykl</th>
                            <th>Data początku wypożyczenia</th>
                            <th>Data końca wypożyczenia</th>
                            <th></th>
        					
        				</tr>
        			</thead>

        			<tbody>
        				@foreach ($wypo as $wypoz)
                        @if ($wypoz->aktywne == '1')
        				<tr>
							<td>
                                {{ $wypoz->users['name'] }}
                            </td>
                            <td>
                                {{ $wypoz->moto['marka'] }} {{ $wypoz->moto['model'] }}  o numerze identyfikacyjnym: {{ $wypoz->moto['id'] }}
                            </td>
                            <td>
                                {{ $wypoz->wypo_od }}
                            </td>
                            <td>
                                {{ $wypoz->wypo_do }}
                            </td>
                            <td>
                                <a href="{{ url('/wypo/res/'. $wypoz->id) }}" class="btn btn_primary"> Przyjmij</a>
                            </td>
        				</tr>
                        @endif
        				@endforeach
        			</tbody>
        		</table>
        		@endif
        </div>

@endsection