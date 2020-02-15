@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.user.create')}}" class="btn btn-primary">Add new user</a>
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
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($users->count() === 0)
                                <tr>
                                    <td colspan="5" class="text-center pt-4">No records found.</td>
                                </tr>
                            @endif
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="Firstname">{{$user->firstname ?? ""}}</td>
                                    <td data-label="Lastname">{{$user->lastname ?? ""}}</td>
                                    <td data-label="Email">{{$user->email ?? ""}}</td>
                                    <td data-label="Edit"><a href="{{route('admin.user.edit',$user->id)}}" class="text-white"><i class="far fa-edit"></i></a></td>
                                    <td data-label="Delete">
                                        <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$user->id}}').submit();" href="#" class="text-white"><i class="far fa-trash-alt"></i></a>
                                        <form action="{{route('admin.user.destroy',$user->id)}}" method="POST" class="d-none" id="delete-form-{{$user->id}}">
                                            {{method_field('DELETE')}}
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="m-auto">{{ $users->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
