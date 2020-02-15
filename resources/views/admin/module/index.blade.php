@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        @if(checkPermissions('module.create',false))
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.module.create')}}" class="btn btn-primary">Add new module</a>
            </div>
        </div>
        @endif
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
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($modules->count() === 0)
                                <tr>
                                    <td colspan="4" class="text-center pt-4">No records found.</td>
                                </tr>
                            @endif
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{$module->name ?? ""}}</td>
                                    <td>{{$module->short_name ?? ""}}</td>
                                    <td data-label="Edit">
                                        @if(checkPermissions('module.update',false))
                                            <a href="{{route('admin.module.edit',$module->id)}}" class="text-white"><i class="far fa-edit"></i></a>
                                        @endif
                                    </td>
                                    <td data-label="Delete">
                                        @if(checkPermissions('module.delete',false))
                                        <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$module->id}}').submit();" href="#" class="text-white"><i class="far fa-trash-alt"></i></a>
                                        <form action="{{route('admin.user.destroy',$module->id)}}" method="POST" class="d-none" id="delete-form-{{$module->id}}">
                                            {{method_field('DELETE')}}
                                            @csrf
                                        </form>
                                        @endif
                                    </td>
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
