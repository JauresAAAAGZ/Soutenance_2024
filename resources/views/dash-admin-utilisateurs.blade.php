@extends("layout.app")

@section("content")
@php
    $stats = [
        [
            'titre' => 'Comptes',
            'total' => App\Models\User::count(),
            'detail' => 'Accès à la plateforme',
            'icone' => 'ri-account-circle-line',
            'lien' => route('users.index'),
        ],
        [
            'titre' => 'Étudiants',
            'total' => App\Models\Etudiant::count(),
            'detail' => 'Créer, modifier, supprimer',
            'icone' => 'ri-graduation-cap-line',
            'lien' => route('etudiants.index'),
        ],
        [
            'titre' => 'Professeurs',
            'total' => App\Models\Professeur::count(),
            'detail' => 'Créer, modifier, supprimer',
            'icone' => 'ri-briefcase-4-line',
            'lien' => route('professeurs.index'),
        ],
        [
            'titre' => 'Administrateurs',
            'total' => App\Models\Admin::count(),
            'detail' => 'Créer, modifier, supprimer',
            'icone' => 'ri-user-settings-line',
            'lien' => route('admins.index'),
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
                                            <h1 class="ef-page-title">Utilisateurs</h1>
                                            <p class="ef-page-subtitle">Comptes de connexion et fiches des étudiants, professeurs et administrateurs</p>
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
