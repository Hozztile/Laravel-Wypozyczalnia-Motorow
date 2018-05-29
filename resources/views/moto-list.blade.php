@extends('layouts.app')

@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
            <h1>Lista Motocykli</h1>
            @guest
            @else 
            @if(Auth::user()->auth == '3' OR Auth::user()->auth == '2')
                <a href="/moto/dodaj" class="btn btn-primary" style="float: right; margin-right: 1px;"> Dodaj motocykl </a><br><br>
            @endif
            @endguest

            <form method="post" action="{{ url('/moto/search') }}">
                <select class="form-control" name="szukaj_marka">
                    <option value="" disabled selected>Marka</option>
                    @foreach($marka as $markaa)
                        <option value="{{ $markaa->id }}">{{ $markaa->nazwa }}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control" placeholder="Model" name="szukaj_model" >
                <input type="hidden" name="_token" value=" {{ csrf_token() }}"><br>
                <div style=" width:50px; margin:0 auto; text-align: center; float: center;"><button type="submit" class="btn btn-primary" >Wyszukaj</button></div><br><br> 
             </form>
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

                
                <table class="table table-striped table-bordered" style="width: 100%; ">
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
                                <p><b>{{$motor->marka['nazwa']}} {{$motor->model}}</b></p>
                                <p>Pojemnośc: {{$motor->pojemnosc}} cm3</p>
                                <p>Moc: {{$motor->moc}} KM</p>
                                <p>Waga: {{$motor->waga}} kg</p>
                                        <p>Aktywne rezerwacje: <br>
                                                @if( $motor->dostep == '1' )
                                                    @foreach ($motor->wypo as $cos)
                                                        {{ $cos->wypo_od }} - {{ $cos->wypo_do }} <br>
                                                    @endforeach
                                                    
                                                @endif
                                                @if( $motor->dostep == '0' )
                                                    {{ $motor->wypo()->count() }}
                                                @endif
                                </p>
                                
                            </td>
                            @guest
                            @else
                            <td style="width: 50px;">
                            @if(Auth::user()->auth == '3' OR Auth::user()->auth == '2')
                                <a href="{{ url('/moto/service/'. $motor->id) }}" class="btn btn-primary"> Zaplanuj konserwację</a><br><br>
                                <a href="{{ url('/moto/edit/'. $motor->id) }}" class="btn btn-primary" style="min-width: 100%"> Edytuj</a><br><br>
                                <a href="{{ url('/moto/delete/'. $motor->id) }}" class="btn btn-primary" style="min-width: 100%"> Usuń</a>
                            </td>
                            @endif
                            @if(Auth::user()->auth == '1' AND $motor->dostep == '1')
                                <a href="{{ url('/moto/loan/'. $motor->id) }}" class="btn btn-primary"> Rezerwuj</a><br><br>
                            </td>
                            @endif
                            @endguest
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>

@endsection