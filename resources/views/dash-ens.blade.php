@extends("layout.app")

@section("content")
<?php
    $professeur = Auth::user()->professeur;
    $depotsDisponibles = App\Models\Depot::with('matiere')->where('professeur_id', $professeur->id)->latest()->get();
    $nbOuverts = $depotsDisponibles->where('etat', '!=', 'fermé')->count();
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
                                            <p class="ef-page-subtitle">
                                                {{ ucfirst(now()->locale('fr')->isoFormat('dddd D MMMM YYYY')) }} · Dépôts ouverts : {{ $nbOuverts }} sur {{ $depotsDisponibles->count() }}
                                            </p>
                                        </div>
                                    </div>

                                    @if(session('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif

                                    <h2 class="ef-section-title">Mes dépôts</h2>

                                    @if ($depotsDisponibles->isEmpty())
                                        <div class="ef-empty">
                                            <i class="ri-folder-add-line"></i>
                                            Vous n'avez pas encore créé de dépôt.
                                            <div class="mt-3">
                                                <a href="{{ route('depots.create') }}" class="btn btn-primary">Créer un dépôt</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            @foreach ($depotsDisponibles as $depot)
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

@endsection
