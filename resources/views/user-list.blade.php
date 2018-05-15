@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <br>
        <h1>Użytkownicy</h1>
        </div>
    </div>
	
	<div class="row">
        <div class="col-md-12">

        	@if ($users->count() > 0 )
        		
                <table class="table table-striped table-bordered ">
        			<thead>

        				<tr class="info">
        					<th>Użytkownik</th>
        					<th></th>
        				</tr>
        			</thead>

        			<tbody>
        				@foreach ($users as $user)
        				<tr>
        					@if ($user->auth == '3')
                            <td>Admin</td>
                            <td>Zablokowane</td>
                            @else

                            <td>{{$user->name}}
                                
                            </td>
							<td>

								<a href="{{ url('/user/edit/'. $user->id) }}"> Edytuj</a> /
								<a href="{{ url('/user/delete/'. $user->id) }}"> Usuń</a>
							</td>
                            @endif
        				</tr>
        				@endforeach
        			</tbody>
        		</table>
        		@endif
        </div>

@endsection