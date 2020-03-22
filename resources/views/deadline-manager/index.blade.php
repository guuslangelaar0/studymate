@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <a href="{{route('guest.user',auth()->user()->id)}}" class="btn btn-primary">My Dashboard</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Modules
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Short Name</th>
                                <th scope="col">Teachers</th>
                                <th scope="col">Coordinators</th>
                                <th scope="col">Enroll</th>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td> {{$module->name}}</td>
                                    <td> {{$module->short_name}}</td>
                                    <td>
                                        @if(count($module->teachers) != 0)
                                        <ul class="list-unstyled">
                                            @foreach($module->teachers as $teacher)
                                                <li>{{$teacher->firstname}}</li>
                                            @endforeach
                                        </ul>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($module->coordinators) != 0)
                                            <ul class="list-unstyled">
                                                @foreach($module->coordinators as $coordinator)
                                                    <li>{{$coordinator->firstname}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth()->user()->modules->find($module->id) != null)
                                            <form action="{{route('admin.dm.unenroll',$module->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger" type="submit">Unenroll</button>
                                            </form>

                                        @else
                                            <form action="{{route('admin.dm.enroll',$module->id)}}" method="post">
                                                @csrf
                                                <button class="btn btn-primary" type="submit">Enroll</button>
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
        @if (count($examsNotEnrolled))
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Exams
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th scope="row">Module</th>
                                <th scope="row">Exam</th>
                                <th scope="row">Start Date</th>
                                <th scope="row">End Date</th>
                                <th scope="row"></th>
                            </thead>
                            <tbody>
                            @foreach($examsNotEnrolled as $exam)
                                <tr>
                                    <td data-label="Module">{{$exam->module->short_name ?? "N/A"}}</td>
                                    <td data-label="Exam">{{$exam->label ?? "N/A"}}</td>
                                    <td data-label="Start Date">{{\Carbon\Carbon::parse($exam->start_date)->format("d-m-Y H:m") ?? "N/A"}}</td>
                                    <td data-label="End Date">{{\Carbon\Carbon::parse($exam->end_date)->format("d-m-Y H:m") ?? "N/A"}}</td>
                                    <td data-label="Remove">
                                        <form action="{{route('admin.dm.enroll_exam', $exam->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-primary" type="submit">Add</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Deadlines
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th scope="row">Module</th>
                                <th scope="row">Exam</th>
                                <th scope="row">Start Date</th>
                                <th scope="row">End Date</th>
                                <th scope="row">Tag</th>
                                <th scope="row">Finished</th>
                                <th scope="row"></th>
                            </thead>
                            <tbody>
                            @foreach($examsEnrolled as $exam)
                                <tr>
                                    <td data-label="Module">{{$exam->module->short_name ?? "N/A"}}</td>
                                    <td data-label="Exam">{{$exam->label ?? "N/A"}}</td>
                                    <td data-label="Start Date">{{\Carbon\Carbon::parse($exam->start_date)->format("d-m-Y H:m") ?? "N/A"}}</td>
                                    <td data-label="End Date">{{\Carbon\Carbon::parse($exam->end_date)->format("d-m-Y H:m") ?? "N/A"}}</td>
                                    <td data-label="Tag">{{$exam->pivot->tag}}</td>
                                    <td data-label="Finished">
                                        <form action="#" method="post" class="form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$exam->id}}">
                                            <input type="checkbox" name="finished" {{$exam->pivot->finished == true ? "checked" : ""}} />
                                        </form>
                                    </td>
                                    <td data-label="Remove">
                                        <a onclick="event.preventDefault(); document.getElementById('delete-user-exam-{{$exam->id}}').submit();" href="#" class="text-white"><i class="fas fa-trash-alt"></i></a>
                                        <form action="{{route('admin.dm.unenroll_exam', $exam->id)}}" method="POST" class="d-none" id="delete-user-exam-{{$exam->id}}">
                                            {{method_field('DELETE')}}
                                            @csrf
                                        </form>
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
