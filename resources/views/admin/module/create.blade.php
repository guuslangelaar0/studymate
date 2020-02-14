@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create new module</div>
                    <div class="card-body">
                        <form action="{{route('admin.module.store')}}" method="post" class="col-6 m-auto">
                            {{method_field('POST')}}
                            {{csrf_field()}}
                            <div class="form-group row">
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group row">
                                <input type="text" class="form-control" name="short_name" placeholder="Short name">
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
