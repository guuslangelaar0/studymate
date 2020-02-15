@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        @if(checkPermissions('module.create',false))
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.permission.create')}}" class="btn btn-primary">Add new permission</a>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Label</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($permissions->count() === 0)
                                <tr>
                                    <td colspan="4" class="text-center pt-4">No records found.</td>
                                </tr>
                            @endif
                            @foreach($permissions as $permission)
                                <tr>
                                    <td data-label="Firstname">{{$permission->name ?? ""}}</td>
                                    <td data-label="Lastname">{{$permission->label ?? ""}}</td>
                                    <td data-label="Edit">
                                        @if(checkPermissions('permission.update',false))
                                            <a href="{{route('admin.permission.edit',$permission->id)}}" class="text-white"><i class="far fa-edit"></i></a>
                                        @endif
                                    </td>
                                    <td data-label="Delete">
                                        @if(checkPermissions('permission.delete',false))
                                            <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$permission->id}}').submit();" href="#" class="text-white"><i class="far fa-trash-alt"></i></a>
                                            <form action="{{route('admin.permission.destroy',$permission->id)}}" method="POST" class="d-none" id="delete-form-{{$permission->id}}">
                                                {{method_field('DELETE')}}
                                                @csrf
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="m-auto">{{ $permissions->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
