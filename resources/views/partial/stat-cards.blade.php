<div class="row">
    @foreach ($stats as $stat)
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <a href="{{ $stat['lien'] }}"><i class="{{ $stat['icone'] }} card1-icon"></i></a>
                    <span class="text-c-blue f-w-600">{{ $stat['titre'] }}</span>
                    <h4>{{ $stat['total'] }}</h4>
                    <a href="{{ $stat['lien'] }}" class="ef-stat-detail" title="{{ $stat['detail'] }}">
                        {{ $stat['detail'] ?: 'Aucun élément' }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
