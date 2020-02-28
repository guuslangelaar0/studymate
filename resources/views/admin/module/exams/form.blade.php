@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @isset($exam)
                            Edit Exam {{$exam->name}}
                        @else
                            Create new exam
                        @endisset
                    </div>
                    <div class="card-body">
                        <form action="{{isset($exam) ? route('admin.module.exam.update',['module_id' => $module->id, 'id' => $exam->id]) : route('admin.module.exam.store',$module->id)}}" method="post" class="small-form m-auto">
                            {{isset($exam) ? method_field('PUT') : method_field('POST')}}
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="label">Label</label>
                                <input type="text" id="label" class="form-control" name="label" placeholder="Name" value="{{$exam->name ?? ""}}">
                            </div>
                            <div class="form-group row">
                                <label for="type">Type</label>
                                <select name="type" class="form-control" id="id">
                                        @foreach(\App\Models\Exam::getPossibleTypes() as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="start_date">Start Date</label>
                                <input type="datetime-local" id="start_date" class="form-control" name="start_date" >
                            </div>
                            <div class="form-group row">
                                <label for="end_date">End Date</label>
                                <input type="datetime-local" id="end_date" class="form-control" name="end_date" >
                            </div>
                            <div class="form-group row">
                                <a href="{{route('admin.module.exam.index',$module->id)}}" class="btn btn-secondary btn-block">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
