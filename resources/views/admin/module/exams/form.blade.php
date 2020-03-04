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
                            <input type="hidden" name="module_id" value="{{$module->id}}">
                            <div class="form-group row">
                                <label for="label">Label</label>
                                <input type="text" id="label" class="form-control" name="label" placeholder="Label" value="{{old('label',$exam->label ?? "" )}}">
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
                                <input type="datetime-local" id="start_date" class="form-control" name="start_date" value="{{str_replace("UTC", 'T', date("yy-m-dTh:m"))}}">
                            </div>
                            <div class="form-group row">
                                <label for="end_date">End Date</label>
                                <input type="datetime-local" id="end_date" class="form-control" name="end_date" value="{{str_replace("UTC", 'T', date("yy-m-dTh:m", strtotime('+7 days')))}}">
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
