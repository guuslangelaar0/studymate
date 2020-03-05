@extends('layouts.guest.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Welcome</div>

                    <div class="card-body">
                        <p>
                            Zie resultaten per gebruiken, klik op een naam om door te gaan.
                        </p>
                        @foreach($users as $user)
                            <a href="{{ route('guest.user', ['id' => $user->id]) }}">{{$user->firstname}}&nbsp;{{$user->lastname}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
