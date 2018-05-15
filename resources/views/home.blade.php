@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Zalogowano!
                </div>
            </div>
        </div>
    </div>
</div>

<script>window.setTimeout(function(){

        window.location.href = "/";

    }, 1000);
    </script>
@endsection
