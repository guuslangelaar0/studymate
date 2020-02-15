@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.role.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left mr-3"></i> Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($role))
                            Update Role: {{$role->name}} - {{ $role->label }}
                        @else
                            Create new Role
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ isset($role) ? route('admin.role.update',$role->id) : route('admin.role.store')}}" method="post" class="form p-5 m-auto">
                            {{csrf_field()}}
                            {{ isset($role) ? method_field('PUT') : method_field('POST')}}
                            <div class="row">
                                <div class="col-12 col-xl-6 mx-auto">
                                    <div class="form-group row">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{$role->name ?? ""}}">
                                    </div>
                                    <div class="form-group row">
                                        <label for="label">Label</label>
                                        <input type="text" id="label" class="form-control" name="label" placeholder="Label" value="{{$role->label ?? ""}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="selectAll"><label for="selectAll" id="selectAll-label">Select All</label>
                                        @php($counter = 0)
                                        @foreach($permissions as $permission)
                                            @if($counter == 0 || explode(".",$permissions[$counter -1]->name)[0] != explode(".",$permission->name)[0])
                                                </div>
                                                <div class="row mb-3 border-bottom">
                                                    <div class="col-12">
                                                        <h5 class="text-capitalize">{{explode(".",$permission->name)[0]}}</h5>
                                                    </div>
                                            @endif
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="checkbox" id="checkbox-{{$permission->id}}"
                                                           class="form-check d-inline-block" name="permissions[]"
                                                           {{isset($role) ? ($role->permissions->find($permission->id) != null ? 'checked' : '') : ''}}
                                                           value="{{$permission->id}}">
                                                    <label for="checkbox-{{$permission->id}}">{{$permission->name}}</label>
                                                </div>
                                            @php($counter++)
                                        @endforeach
                                    </div>
                                    <div class="form-group row">
                                        <a href="{{route('admin.role.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
