@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.module.create')}}" class="btn btn-primary">Add new module</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Modules</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Short name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($modules->count() === 0)
                                <tr>
                                    <td colspan="2" class="text-center pt-4">No records found.</td>
                                </tr>
                            @endif
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{$module->name ?? ""}}</td>
                                    <td>{{$module->short_name ?? ""}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
