@extends("layout.app")

@section("content")
@php
    $role = Auth::user()->role_id;
    $ferme = $depot->etat == 'fermé';
    $emailProfesseur = $depot->professeur?->user?->email;

    $estNote = fn ($media) => strpos($media->file_name, 'notes') === 0;
    $estRessource = fn ($media) => $media->getCustomProperty('user_email') === $emailProfesseur;

    $medias = $depot->getMedia();
    $releves = $medias->filter($estNote);
    $ressources = $medias->reject($estNote)->filter($estRessource);
    $rendus = $medias->reject($estNote)->reject($estRessource);
    $mesRendus = $rendus->filter(fn ($media) => $media->getCustomProperty('user_email') === Auth::user()->email);
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

                                <div class="ef-page-header">
                                    <div>
                                        <h1 class="ef-page-title">{{ $depot->nomDepot }}</h1>
                                        <p class="ef-page-subtitle">
                                            {{ $depot->matiere->intitule ?? '' }}
                                            @if ($depot->professeur)
                                                · {{ $depot->professeur->prenomProfesseur }} {{ $depot->professeur->nomProfesseur }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="ef-badge {{ $ferme ? 'ef-badge-closed' : 'ef-badge-open' }}">{{ $ferme ? 'Fermé' : 'Ouvert' }}</span>
                                        <div class="text-muted mt-2">
                                            Fermeture : {{ \Carbon\Carbon::parse($depot->dateFermeture)->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm') }}
                                            · <span class="js-countdown" data-depot="{{ $depot->id }}" data-closing="{{ $depot->dateFermeture }}" data-etat="{{ $depot->etat }}"></span>
                                        </div>
                                        @if ($role == 2 && $ferme)
                                            <a href="{{ route('depots.students', $depot) }}" class="btn btn-primary mt-2">Saisir les notes</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-block">
                                        <strong>Consignes</strong>
                                        <p class="mb-0 mt-1">{{ $depot->description }}</p>
                                    </div>
                                </div>

                                @foreach (['message1' => 'success', 'message' => 'success', 'error' => 'danger'] as $cle => $type)
                                    @if(session($cle))
                                        <div class="alert alert-{{ $type }} js-flash">{{ session($cle) }}</div>
                                    @endif
                                @endforeach

                                {{-- Ressources jointes par le professeur --}}
                                @if ($role == 1 || $role == 2)
                                    <h2 class="ef-section-title">Ressources</h2>
                                    @include('depots.partials.fichiers', [
                                        'fichiers' => $ressources,
                                        'vide' => "Aucune ressource n'a été jointe à ce dépôt.",
                                        'suppression' => $role == 2,
                                    ])
                                @endif

                                {{-- Rendu de l'étudiant connecté --}}
                                @if ($role == 1)
                                    <h2 class="ef-section-title">Mon rendu</h2>
                                    @include('depots.partials.fichiers', [
                                        'fichiers' => $mesRendus,
                                        'vide' => $ferme ? "Le dépôt est fermé et vous n'avez rien rendu." : "Vous n'avez encore rien déposé.",
                                        'suppression' => !$ferme,
                                    ])

                                    @if (!$ferme && $mesRendus->isEmpty())
                                        <form id="uploadForm" action="{{ route('depots.add-files', $depot) }}" method="post" enctype="multipart/form-data" class="mt-3">
                                            @csrf
                                            <div id="dropZone" class="drop-zone">
                                                <label for="fileInput" id="fileInputLabel">
                                                    <i class="ri-upload-cloud-2-line"></i>
                                                    Glissez votre fichier ici ou cliquez pour le choisir<br>
                                                    <small>Formats acceptés : .zip, .rar, .pdf</small>
                                                </label>
                                                <input type="file" name="fichiers[]" id="fileInput" accept=".zip, .rar, .pdf" multiple>
                                            </div>
                                            <div class="text-right mt-3">
                                                <button type="submit" id="uploadButton" class="btn btn-primary" disabled>Envoyer</button>
                                            </div>
                                        </form>
                                    @endif
                                @endif

                                {{-- Rendus de tous les étudiants --}}
                                @if ($role == 2)
                                    <h2 class="ef-section-title">Rendus des étudiants ({{ $rendus->count() }})</h2>
                                    @include('depots.partials.fichiers', [
                                        'fichiers' => $rendus,
                                        'vide' => "Aucun étudiant n'a encore rendu de fichier.",
                                        'suppression' => false,
                                    ])
                                @endif

                                {{-- Relevés de notes générés --}}
                                @if ($role == 2 || $role == 4)
                                    <h2 class="ef-section-title">Relevés de notes</h2>
                                    @include('depots.partials.fichiers', [
                                        'fichiers' => $releves,
                                        'vide' => $ferme ? "Les notes n'ont pas encore été saisies." : "Le relevé sera disponible après la fermeture du dépôt.",
                                        'suppression' => $role == 2,
                                    ])
                                @endif

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

    document.addEventListener('DOMContentLoaded', function () {
        var dropZone = document.getElementById('dropZone');
        if (!dropZone) {
            return;
        }

        var fileInput = document.getElementById('fileInput');
        var label = document.getElementById('fileInputLabel');
        var bouton = document.getElementById('uploadButton');

        function afficherFichiers() {
            var n = fileInput.files.length;
            bouton.disabled = n === 0;
            if (n === 0) {
                return;
            }

            var icone = document.createElement('i');
            icone.className = 'ri-file-zip-line';
            label.textContent = n === 1 ? fileInput.files[0].name : n + ' fichiers sélectionnés';
            label.prepend(icone);
        }

        dropZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', function () {
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', function (e) {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            fileInput.files = e.dataTransfer.files;
            afficherFichiers();
        });

        fileInput.addEventListener('change', afficherFichiers);
    });
</script>

@endsection
