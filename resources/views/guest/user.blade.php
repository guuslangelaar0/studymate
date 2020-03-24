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
                                <ul class="list-unstyled mb-3">
                                    <li>
                                        <b>Voornaam:</b>
                                        {{$user->firstname}}
                                    </li>
                                    <li>
                                        <b>Achternaam:</b> {{$user->lastname}}
                                    </li>
                                    <li>
                                        <b>E-mail adres:</b> {{$user->email}}
                                    </li>
                                    <li>
                                        <b>Profiel aangemaakt op:</b> {{date('d/m/Y H:m:s', strtotime($user->created_at))}}
                                    </li>
                                </ul>
                                <?php
                                    $EC = 0;
                                    foreach(auth()->user()->modules as $m) {
                                        $EC += $m->exams->sum('ec');
                                    }

                                    $acEC = auth()->user()->exams()->where('finished',1)->pluck('ec')->sum();

                                    // using @ because 0 / 0 gives error, now gives NAN
                                    $perc = @($acEC / $EC) * 100;
                                ?>
                                <h3>Voortgangsmeter</h3>
                                <div class="progress mb-3" style="height: 2rem;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{is_nan($perc) ? 0 : $perc}}%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$acEC}} van {{$EC }} EC</div>
                                </div>
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
                                                <?php
                                                $blockModules = $user->modules->where('block',$block['nr']);
                                                $totalEC = 0;
                                                $achievedEC = 0;
                                                if($blockModules->count() > 0) {
                                                    foreach($blockModules as $bm) {
                                                        $totalEC += $bm->exams->sum('ec');
                                                        $achievedEC += auth()->user()->exams()->where('module_id',$bm->id)->where('finished',1)->pluck('ec')->sum();
                                                    }
                                                }
                                                ?>
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Blok {{ $block['nr'] ?? "" }}
                                                        <i class="fas fa-info-circle float-right more-information-btn block-info"></i>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table d-none">
                                                            <tr>
                                                                <td>Totaal EC</td>
                                                                <td>{{$totalEC}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Behaald EC</td>
                                                                <td>{{$achievedEC}}</td>
                                                            </tr>
                                                        </table>
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
                                                                    <i class="fas fa-info-circle float-right more-information-btn module-info"></i>
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
                                                                                <td>{{auth()->user()->exams()->where('module_id',$module->id)->where('finished',1)->pluck('ec')->sum() ?? "N/A"}}</td>
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
