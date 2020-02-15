@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.role.create')}}" class="btn btn-primary">Add new role</a>
            </div>
        </div>
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
                            @if($roles->count() === 0)
                                <tr>
                                    <td colspan="4" class="text-center pt-4">No records found.</td>
                                </tr>
                            @endif
                            @foreach($roles as $role)
                                <tr>
                                    <td data-label="Firstname">{{$role->name ?? ""}}</td>
                                    <td data-label="Lastname">{{$role->label ?? ""}}</td>
                                    <td data-label="Edit"><a href="{{route('admin.role.edit',$role->id)}}" class="text-white"><i class="far fa-edit"></i></a></td>
                                    <td data-label="Delete">
                                        <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$role->id}}').submit();" href="#" class="text-white"><i class="far fa-trash-alt"></i></a>
                                        <form action="{{route('admin.role.destroy',$role->id)}}" method="POST" class="d-none" id="delete-form-{{$role->id}}">
                                            {{method_field('DELETE')}}
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="m-auto">{{ $roles->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
