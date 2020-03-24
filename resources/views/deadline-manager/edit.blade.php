@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <a href="{{route('admin.dm.index')}}" class="btn btn-primary">Return to Deadline Manager</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Editing exam: {{$exam->label}}
                    </div>
                    <div class="card-body">
                        <form action="{{route("admin.dm.exam.update",$exam->id)}}" class="form col-6 mx-auto" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('put')}}
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="name">Exam: </label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="name" value="{{$exam->label ?? ""}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="tag">Tag</label>
                                </div>
                                <div class="col-8">
                                    <select name="tag" id="tag" class="form-control">
                                        @foreach($exam->getPossibleTags() as $tag)
                                            <option value="{{$tag}}">{{$tag}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="file">Bestand uploaden (zip)</label>
                                </div>
                                <div class="col-8">
                                    <input type="file" name="file" class="form-control-file" id="file" accept=".zip,.rar">

                                    @if($exam->pivot->file != null)
                                        <a href="/storage/{{$exam->pivot->file}}" download>Download Zip</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="finished">Finished</label>
                                </div>
                                <div class="col-8">
                                    <input type="checkbox" value="1" name="finished" id="finished" {{$exam->pivot->finished == true ? "checked" : ""}}>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="grade" >Cijfer</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" name="grade" min="0" max="10" step="0.01" class="form-control" value="{{$exam->pivot->grade}}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Opslaan</button>
                            <a href="{{route('admin.dm.index')}}" class="btn btn-link">Annuleren</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
