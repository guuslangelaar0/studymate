@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        @if(checkPermissions('module.create',false))
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('admin.module.exam.create',$module->id)}}" class="btn btn-primary">Add new exam</a>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Exams</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Label</th>
                                <th scope="col">Type</th>
                                <th scope="col">Start date</th>
                                <th scope="col">End date</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($exams->count() === 0)
                                <tr>
                                    <td colspan="6" class="text-center pt-4">No records found.</td>
                                </tr>
                            @endif
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{$exam->label ?? ""}}</td>
                                    <td>{{$exam->type ?? ""}}</td>
                                    <td>{{$exam->start_date ?? ""}}</td>
                                    <td>{{$exam->end_date ?? ""}}</td>
                                    <td data-label="Edit">
                                        @if(checkPermissions('module.update',false))
                                            <a href="{{route('admin.module.edit',$exam->id)}}" class="text-white"><i class="far fa-edit"></i></a>
                                        @endif
                                    </td>
                                    <td data-label="Delete">
                                        @if(checkPermissions('module.delete',false))
                                        <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$exam->id}}').submit();" href="#" class="text-white"><i class="far fa-trash-alt"></i></a>
                                        <form action="{{route('admin.module.exam.destroy',$exam->id)}}" method="POST" class="d-none" id="delete-form-{{$exam->id}}">
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
