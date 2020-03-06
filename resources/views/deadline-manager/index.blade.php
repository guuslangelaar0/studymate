@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        Modules--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                                <th scope="col">Name</th>--}}
{{--                                <th scope="col">Short Name</th>--}}
{{--                                <th scope="col">Teachers</th>--}}
{{--                                <th scope="col">Coordinators</th>--}}
{{--                            </thead>--}}
{{--                            <tr>--}}
{{--                                @foreach($modules as $module)--}}
{{--                                    <td> {{$module->name}}</td>--}}
{{--                                    <td> {{$module->short_name}}</td>--}}
{{--                                    <td>--}}
{{--                                        @if(count($module->teachers) != 0)--}}
{{--                                        <ul class="list-unstyled">--}}
{{--                                            @foreach($module->teachers as $teacher)--}}
{{--                                                <li>{{$teacher->firstname}}</li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                        @else--}}
{{--                                            N/A--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        @if(count($module->coordinators) != 0)--}}
{{--                                            <ul class="list-unstyled">--}}
{{--                                                @foreach($module->coordinators as $coordinator)--}}
{{--                                                    <li>{{$coordinator->firstname}}</li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        @else--}}
{{--                                            N/A--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                @endforeach--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Deadlines
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th scope="col">Module</th>
                                <th scope="col">Exam</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{$exam->module->short_name ?? ""}}</td>
                                    <td>{{$exam->label ?? ""}}</td>
                                    <td>{{\Carbon\Carbon::parse($exam->start_date)->format("d-m-Y") ?? ""}}</td>
                                    <td>{{\Carbon\Carbon::parse($exam->end_date)->format("d-m-Y") ?? ""}}</td>
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
