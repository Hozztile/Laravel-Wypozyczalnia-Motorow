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

            @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

            

            <form method="post" action="{{ url('/moto/search') }}">
                <select class="form-control" name="szukaj_marka">
                    <option value="" disabled selected>Marka</option>
                    @foreach($marka as $markaa)
                        <option value="{{ $markaa->id }}">{{ $markaa->nazwa }}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control" placeholder="Model.." name="szukaj_model" >
                <!--<input type="number" class="form-control" placeholder="Pojemność od.." name="szukaj_poj" >
                <input type="number" class="form-control" placeholder="Moc od.." name="szukaj_moc" >
                <input type="number" class="form-control" placeholder="Waga od.." name="szukaj_waga" >-->
                <input type="hidden" name="_token" value=" {{ csrf_token() }}"><br>
                <div style=" width:50px; margin:0 auto; text-align: center; float: center;"><button type="submit" class="btn btn-primary" >Wyszukajjjjjjjj</button></div><br><br> 
             </form>
            <br>


        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

                
                <table class="table table-striped table-bordered" style="width: 100%; ">
                    <thead>

                        <tr class="info">
                            <th>Motocykle</th>
                            <th>Opis</th>
                            <th>Akcje</th>
                            
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
                                        <p>Sprawdź dostępność: <br>
                                               <!-- @if( $motor->dostep == '1' )
                                                    @foreach ($motor->wypo as $cos)
                                                        {{ $cos->wypo_od }} - {{ $cos->wypo_do }} <br>
                                                    @endforeach
                                                @endif-->

                                            <form action="{{ url('/check') }}" method="post">
                                                <input type="date" name="spr_data_od" placeholder="Od.." required> &nbsp&nbsp
                                                <input type="date" name="spr_data_do" placeholder="Do.." required>
                                                <input type="hidden" name="id_moto" value="{{ $motor->id }}">
                                                <input type="hidden" name="_token" value=" {{ csrf_token() }}"><br><br>
                                                <input type="submit" name="submit" class="btn btn-primary" value="Sprawdź">
                                            </form>
                                               
                                </p>
                                <p><b>Cena: {{ $motor->cena }} zł</b></p>
                                
                            </td>
                            @guest
                            <td style="width: 50px;">
                            <a href="{{ url('/log-or-reg') }}" class="btn btn-primary"> Rezerwuj</a><br><br>
                            </td>
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