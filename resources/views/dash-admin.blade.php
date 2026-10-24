@extends("layout.app")

@section("content")
@php
    $stats = [
        [
            'titre' => 'Utilisateurs',
            'total' => App\Models\User::count(),
            'detail' => 'Comptes, étudiants, professeurs',
            'icone' => 'ri-account-pin-circle-line',
            'lien' => route('dashadmin1'),
        ],
        [
            'titre' => 'Filières',
            'total' => App\Models\Filiere::count(),
            'detail' => App\Models\Filiere::pluck('codeFiliere')->implode(', '),
            'icone' => 'ri-contacts-line',
            'lien' => route('filieres.index'),
        ],
        [
            'titre' => 'Niveaux',
            'total' => App\Models\Niveau::count(),
            'detail' => App\Models\Niveau::pluck('codeNiveau')->implode(', '),
            'icone' => 'ri-layout-horizontal-line',
            'lien' => route('niveaux.index'),
        ],
        [
            'titre' => 'Matières',
            'total' => App\Models\Matiere::count(),
            'detail' => App\Models\Matiere::pluck('intitule')->implode(', '),
            'icone' => 'ri-book-marked-line',
            'lien' => route('matieres.index'),
        ],
    ];
@endphp

<div class="theme-loader"></div>

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        @include("partial.headbar")
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include("partial.sidebar")
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">

                                    <div class="ef-page-header">
                                        <div>
                                            <h1 class="ef-page-title">Administration</h1>
                                            <p class="ef-page-subtitle">{{ ucfirst(now()->locale('fr')->isoFormat('dddd D MMMM YYYY')) }}</p>
                                        </div>
                                    </div>

                                    @include('partial.stat-cards', ['stats' => $stats])

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
