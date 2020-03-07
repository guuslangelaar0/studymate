@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Account</div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>
                                <label class="font-weight-bold" for="">Username:</label>
                                <span>{{$user->username ?? ""}}</span>
                            </li>
                            <li>
                                <label class="font-weight-bold" for="">First name:</label>
                                <span>{{$user->firstname ?? ""}}</span>
                            </li>
                            <li>
                                <label class="font-weight-bold" for="">Last name:</label>
                                <span>{{$user->lastname ?? ""}}</span>
                            </li>
                            <li>
                                <label class="font-weight-bold" for="">Email:</label>
                                <span>{{$user->email ?? ""}}</span>
                            </li>
                        </ul>
                        <hr class="divider">
                        @if($user->google_id === null)
                        <div>
                            <label for="" class="d-inline-block">Connect with google: </label>
                            <a href="{{route('admin.account.connect.google')}}">
                                <img class="btn-block d-inline-block" style="width: 200px;" src="{{asset('img/btn_google_sso.png')}}" alt="">
                            </a>
                        </div>
                        @else

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
