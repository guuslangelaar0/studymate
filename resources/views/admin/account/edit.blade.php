@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.account.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left mr-3"></i> Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Update Account: {{$user->firstname}} {{ $user->lastname }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account.update',$user->id) }}" method="post" class="small-form m-auto">
                            {{csrf_field()}}
                            {{ method_field('PUT')}}
                            <div class="form-group row">
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="{{$user->username ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First name" value="{{$user->firstname ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="lastname">Last name</label>
                                <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last name" value="{{$user->lastname ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="email" value="{{$user->email ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password">
                            </div>
                            <div class="form-group row">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" value="{{old('password')}}">
                            </div>
                            <div class="form-group row">
                                <a href="{{route('admin.account.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
