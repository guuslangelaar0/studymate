@extends('layouts.guest.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Voortgang van {{$user->firstname}} {{$user->lastname}}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <ul>
                                    <li>
                                        Voornaam: {{$user->firstname}}
                                    </li>
                                    <li>
                                        Achternaam: {{$user->lastname}}
                                    </li>
                                    <li>
                                        E-mail adres: {{$user->email}}
                                    </li>
                                    <li>
                                        Profiel aangemaakt op: {{date('d/m/Y H:m:s', strtotime($user->created_at))}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    Deel deze QR code met je vrienden zodat zij ook jouw voortgang bij kunnen houden.
                                </p>
                                <img class="w-50 mx-auto d-block" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ route('guest.user', ['id' => $user->id]) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Behaalde modules
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Blok</th>
                                    <th>EC</th>
                                    <th>Cijfer (GEM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($finishedModules as $module)
                                    <tr>
                                        <td>{{$module->short_name ?? ""}}</td>
                                        <td>{{$module->block ?? ""}}</td>
                                        <td>{{$module->exams->sum('ec')}}</td>
                                        <td>{{ number_format(auth()->user()->exams()->where('module_id',$module->id)->pluck('grade')->avg(),1,',','.') ?? "N/A"}}</td>
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
