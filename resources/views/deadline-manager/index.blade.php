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
                                            <form action="{{route('admin.dm.disenroll',$module->id)}}" method="post">
                                                @csrf
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td data-label="Module">{{$exam->module->short_name ?? "N/A"}}</td>
                                    <td data-label="Exam">{{$exam->label ?? "N/A"}}</td>
                                    <td data-label="Start Date">{{\Carbon\Carbon::parse($exam->start_date)->format("d-m-Y") ?? "N/A"}}</td>
                                    <td data-label="End Date">{{\Carbon\Carbon::parse($exam->end_date)->format("d-m-Y") ?? "N/A"}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
