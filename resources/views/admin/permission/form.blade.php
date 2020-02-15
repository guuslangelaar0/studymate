@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.permission.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left mr-3"></i> Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($permission))
                            Update Permission: {{$permission->name}} - {{ $permission->label }}
                        @else
                            Create new Permission
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ isset($permission) ? route('admin.permission.update',$permission->id) : route('admin.permission.store')}}" method="post" class="small-form m-auto">
                            {{csrf_field()}}
                            {{ isset($permission) ? method_field('PUT') : method_field('POST')}}
                            <div class="form-group row">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{$permission->name ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="label">Label</label>
                                <input type="text" id="label" class="form-control" name="label" placeholder="Label" value="{{$permission->label ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <a href="{{route('admin.permission.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
