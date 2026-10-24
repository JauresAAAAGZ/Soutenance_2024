@extends("layout.app")

@section("content")
<?php
    $user = Auth::user();

    // $depots est déjà trié et filtré par la recherche dans le contrôleur
    if ($user->role_id == 2) {
        $liste = $depots->where('professeur_id', $user->professeur->id);
    } elseif ($user->role_id == 1) {
        $etudiant = $user->etudiant;
        $liste = $depots->filter(function ($depot) use ($etudiant) {
            return $depot->niveaux->contains('id', $etudiant->niveau_id)
                && $depot->filieres->contains('id', $etudiant->filiere_id);
        });
    } else {
        $liste = $depots;
    }
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
                                            <h1 class="ef-page-title">Dépôts</h1>
                                            <p class="ef-page-subtitle">{{ $liste->count() }} résultat{{ $liste->count() > 1 ? 's' : '' }}</p>
                                        </div>

                                        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                            <form action="{{ route('depots.index') }}" method="GET">
                                                <div class="input-group">
                                                    <input type="text" name="q" class="form-control" placeholder="Rechercher un dépôt" value="{{ request('q') }}">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary" aria-label="Rechercher"><i class="ri-search-line"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Trier par
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('depots.index', ['sort' => 'latest', 'q' => request('q')]) }}">Du plus récent au plus ancien</a>
                                                    <a class="dropdown-item" href="{{ route('depots.index', ['sort' => 'oldest', 'q' => request('q')]) }}">Du plus ancien au plus récent</a>
                                                    <a class="dropdown-item" href="{{ route('depots.index', ['sort' => 'alphabetical', 'q' => request('q')]) }}">Ordre alphabétique</a>
                                                </div>
                                            </div>
                                            @if ($user->role_id == 2)
                                                <a href="{{ route('depots.create') }}" class="btn btn-primary"><i class="ri-add-line"></i> Nouveau dépôt</a>
                                            @endif
                                        </div>
                                    </div>

                                    @foreach (['message' => 'success', 'error' => 'danger', 'danger' => 'danger'] as $cle => $type)
                                        @if(session($cle))
                                            <div class="alert alert-{{ $type }} js-flash">{{ session($cle) }}</div>
                                        @endif
                                    @endforeach

                                    @if ($liste->isEmpty())
                                        <div class="ef-empty">
                                            <i class="ri-inbox-line"></i>
                                            @if (request('q'))
                                                Aucun dépôt ne correspond à « {{ request('q') }} ».
                                            @else
                                                Aucun dépôt pour le moment.
                                            @endif
                                        </div>
                                    @else
                                        <div class="row">
                                            @foreach ($liste as $depot)
                                                <div class="col-md-6 col-xl-4 mb-4">
                                                    @include('partial.depot-card', ['depot' => $depot])
                                                </div>
                                            @endforeach
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

<script>
    setTimeout(function () {
        document.querySelectorAll('.js-flash').forEach(function (el) { el.style.display = 'none'; });
    }, 4000);
</script>

@endsection
