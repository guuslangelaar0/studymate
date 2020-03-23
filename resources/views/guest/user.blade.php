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
                    <div class="card-header">Overzicht</div>
                    <div class="card-body">
                        <div class="horizontal-scroll-wrapper squares">
                            <?php
                                $periods = [
                                    [
                                        "nr" => 1,
                                        "blocks" => [
                                            [
                                                "nr" => 1,
                                            ],
                                            [
                                                "nr" => 2,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 2,
                                        "blocks" => [
                                            [
                                                "nr" => 3,
                                            ],
                                            [
                                                "nr" => 4,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 3,
                                        "blocks" => [
                                            [
                                                "nr" => 5,
                                            ],
                                            [
                                                "nr" => 6,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 4,
                                        "blocks" => [
                                            [
                                                "nr" => 7,
                                            ],
                                            [
                                                "nr" => 8,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 5,
                                        "blocks" => [
                                            [
                                                "nr" => 9,
                                            ],
                                            [
                                                "nr" => 10,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 6,
                                        "blocks" => [
                                            [
                                                "nr" => 11,
                                            ],
                                            [
                                                "nr" => 12,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 7,
                                        "blocks" => [
                                            [
                                                "nr" => 13,
                                            ],
                                            [
                                                "nr" => 14,
                                            ],
                                        ],
                                    ],
                                    [
                                        "nr" => 8,
                                        "blocks" => [
                                            [
                                                "nr" => 15,
                                            ],
                                            [
                                                "nr" => 16,
                                            ],
                                        ],
                                    ]
                                ]
                            ?>
                            @foreach($periods as $period)
                                <div class="card">
                                    <div class="card-header">Periode {{Arr::get($period,'nr','N/A')}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach(Arr::get($period,'blocks',[]) as $block)
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Blok {{ $block['nr'] ?? "" }}
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach($user->modules->where('block',$block['nr']) as $module)
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    {{$module->short_name}}
                                                                    @php($finished = $finishedModules->where('id',$module->id)->count() != 0)
                                                                    @if($finished)
                                                                        <i class="fas fa-check-circle" style="color: #329AF0;"></i>
                                                                    @else
                                                                        <i class="fas fa-times-circle" style="color: red;"></i>
                                                                    @endif
                                                                    <i class="fas fa-info-circle float-right more-information-btn"></i>
                                                                </div>
                                                                <div class="card-body d-none">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Totaal EC</td>
                                                                                <td>{{$module->exams->sum('ec')}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Behaald EC</td>
                                                                                <td>{{auth()->user()->exams()->where('module_id',$module->id)->pluck('ec')->sum() ?? "N/A"}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Cijfer (Gem)</td>
                                                                                <td>{{ number_format(auth()->user()->exams()->where('module_id',$module->id)->pluck('grade')->avg(),1,',','.') ?? "N/A"}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
