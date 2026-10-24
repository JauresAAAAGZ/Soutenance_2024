@php
    $role = Auth::user()->role_id;
    $ferme = $depot->etat == 'fermé';
    $fermeture = \Carbon\Carbon::parse($depot->dateFermeture)->locale('fr')->isoFormat('D MMM YYYY [à] HH:mm');
@endphp

<div class="card ef-depot-card">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h5><a href="{{ route('depots.show', $depot) }}">{{ $depot->nomDepot }}</a></h5>
            @if ($depot->matiere)
                <small class="text-muted">{{ $depot->matiere->intitule }}</small>
            @endif
        </div>

        <div class="d-flex align-items-center">
            <span class="ef-badge {{ $ferme ? 'ef-badge-closed' : 'ef-badge-open' }}">{{ $ferme ? 'Fermé' : 'Ouvert' }}</span>

            @if ($role == 2)
                <div class="dropdown ml-1">
                    <button class="btn btn-sm btn-link text-muted" type="button" data-toggle="dropdown" aria-expanded="false" aria-label="Actions">
                        <i class="ri-more-2-fill"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('depots.show', $depot) }}">Consulter</a>
                        <a class="dropdown-item" href="{{ route('depots.edit', $depot) }}">Modifier</a>
                        @if ($ferme)
                            <a class="dropdown-item" href="{{ route('depots.students', $depot) }}">Saisir les notes</a>
                        @endif
                        <form action="{{ route('depots.destroy', $depot) }}" method="POST" onsubmit="return confirm('Supprimer le dépôt « {{ addslashes($depot->nomDepot) }} » ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <p class="ef-depot-description">{{ $depot->description }}</p>

    <div class="ef-depot-meta">
        <span><i class="ri-calendar-line"></i> Fermeture : {{ $fermeture }}</span>
        <span><i class="ri-timer-line"></i> <span class="js-countdown" data-depot="{{ $depot->id }}" data-closing="{{ $depot->dateFermeture }}" data-etat="{{ $depot->etat }}"></span></span>
    </div>

    @if ($role == 1)
        <div class="ef-depot-actions">
            <a href="{{ route('depots.show', $depot) }}" class="btn btn-sm btn-primary">Ouvrir</a>
            <a href="{{ route('depots.downloadProfessorFiles', $depot->id) }}" class="btn btn-sm btn-outline-secondary">Ressources</a>
        </div>
    @endif
</div>
