@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($module))
                            Edit module {{$module->name}}
                        @else
                            Create new module
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{isset($module) ? route('admin.module.update',$module->id) : route('admin.module.store')}}" method="post" class="small-form m-auto">
                            {{isset($module) ? method_field('PUT') : method_field('POST')}}
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{$module->name ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="short_name">Short name</label>
                                <input type="text" id="short_name" class="form-control" name="short_name" placeholder="Short name" value="{{$module->short_name ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="teachers">Teachers</label>
                                <select name="teachers[]" id="teachers" multiple class="form-control">
                                    <option value="" disabled>Select teachers for this class</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}" {{isset($module) ? ($module->teachers->find($teacher->id) !== null ? 'selected' : '') : ''}}>
                                            {{$teacher->firstname}} {{$teacher->lastname}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="coordinators">Coordinators</label>
                                <select name="coordinators[]" id="coordinators" multiple class="form-control">
                                    <option value="" disabled>Select teachers for this class</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}" {{isset($module) ? ($module->coordinators->find($teacher->id) !== null ? 'selected' : '') : ''}}>
                                            {{$teacher->firstname}} {{$teacher->lastname}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <a href="{{route('admin.module.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
