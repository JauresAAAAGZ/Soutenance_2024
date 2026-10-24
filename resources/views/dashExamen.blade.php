@extends("layout.app")

@section("content")
<?php
    $depots = App\Models\Depot::with('professeur')->orderBy('dateFermeture')->get();
?>

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
                                            <h1 class="ef-page-title">Bonjour, {{ Auth::user()->name }}</h1>
                                            <p class="ef-page-subtitle">{{ ucfirst(now()->locale('fr')->isoFormat('dddd D MMMM YYYY')) }} · Suivi de tous les dépôts</p>
                                        </div>
                                    </div>

                                    <div class="card project-task">
                                        <div class="card-header">
                                            <h5>Dépôts</h5>
                                        </div>
                                        <div class="card-block p-b-10">
                                            @if ($depots->isEmpty())
                                                <div class="ef-empty">
                                                    <i class="ri-inbox-line"></i>
                                                    Aucun dépôt n'a encore été créé.
                                                </div>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table table-hover ef-table-stack">
                                                        <thead>
                                                            <tr>
                                                                <th>Dépôt</th>
                                                                <th>Professeur</th>
                                                                <th>État</th>
                                                                <th>Temps restant</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($depots as $depot)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('depots.show', $depot) }}" class="task-contain">
                                                                        <h6 class="d-inline-block text-center">{{ mb_substr($depot->nomDepot, 0, 1) }}</h6>
                                                                        <p class="d-inline-block m-l-20 text-dark">{{ $depot->nomDepot }}</p>
                                                                    </a>
                                                                </td>
                                                                <td data-label="Professeur">
                                                                    @if ($depot->professeur)
                                                                        {{ $depot->professeur->prenomProfesseur }} {{ $depot->professeur->nomProfesseur }}
                                                                    @endif
                                                                </td>
                                                                <td data-label="État">
                                                                    @if ($depot->etat == 'fermé')
                                                                        <span class="ef-badge ef-badge-closed">Fermé</span>
                                                                    @else
                                                                        <span class="ef-badge ef-badge-open">Ouvert</span>
                                                                    @endif
                                                                </td>
                                                                <td data-label="Temps restant">
                                                                    <span class="js-countdown" data-depot="{{ $depot->id }}" data-closing="{{ $depot->dateFermeture }}" data-etat="{{ $depot->etat }}"></span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="{{ route('depots.show', $depot) }}" class="btn btn-sm btn-primary">Ouvrir</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

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
