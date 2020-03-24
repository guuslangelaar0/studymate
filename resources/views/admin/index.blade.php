@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Overview</div>

                    <div class="card-body">
                        Hi {{auth()->user()->firstname}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
