@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.teacher.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left mr-3"></i> Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($teacher))
                            Update teacher: {{$teacher->firstname}} {{ $teacher->lastname }}
                        @else
                            Create new Teacher
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ isset($teacher) ? route('admin.teacher.update',$teacher->id) : route('admin.teacher.store')}}" method="post" class="small-form m-auto">
                            {{csrf_field()}}
                            {{ isset($teacher) ? method_field('PUT') : method_field('POST')}}
                            <div class="form-group row">
                                <label for="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First name" value="{{$teacher->firstname ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="lastname">Last name</label>
                                <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last name" value="{{$teacher->lastname ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="email" value="{{$teacher->email ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <a href="{{route('admin.teacher.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
