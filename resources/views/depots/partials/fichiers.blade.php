@if ($fichiers->isEmpty())
    <div class="ef-empty">
        <i class="ri-file-line"></i>
        {{ $vide }}
    </div>
@else
    <div class="row">
        @foreach ($fichiers as $media)
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-3">
                <div class="card custom-card mb-0">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/images/zip.png') }}" alt="" class="mx-auto d-block">
                        <h6 class="card-title mt-3 mb-1 text-break">{{ $media->file_name }}</h6>
                        <small class="text-muted">{{ $media->human_readable_size }} · {{ $media->created_at->locale('fr')->isoFormat('D MMM YYYY') }}</small>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('depot.download', ['id' => $media->id]) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="ri-download-2-line"></i> Télécharger
                        </a>
                        @if ($suppression)
                            <form action="{{ route('depot.delete-file', ['id' => $media->id]) }}" method="post" onsubmit="return confirm('Supprimer ce fichier ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-icon-action danger" aria-label="Supprimer">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
