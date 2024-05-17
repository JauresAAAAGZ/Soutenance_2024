@extends("layout.app")

@section("content")

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
                                    <div class="col-md-12">
                                        <div class="card project-task">
                                            <div class="card-header">
                                                <h5>Liste des notes des etudiants pour le repertoire @php
                                                    echo $depot->nomDepot;
                                                @endphp</h5>
                                            </div>
                                            <form action="{{ route('depots.submitNotes', ['depot' => $depot->id]) }}" method="POST">
                                                @csrf
                                                <div class="card-block p-b-10">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nom</th>
                                                                    <th>Prénoms</th>
                                                                    <th>Filière</th>
                                                                    <th>Niveau</th>
                                                                    <th>Note</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($students as $student)
                                                                <tr>
                                                                    <td>{{ $student->nomEtudiant }}</td>
                                                                    <td>{{ $student->prenomEtudiant }}</td>
                                                                    <td>{{ $student->filiere->nomFiliere }}</td>
                                                                    <td>{{ $student->niveau->diplome_niveau }}</td>
                                                                    <td>
                                                                        <input type="hidden" name="etudiant_ids[]" value="{{ $student->id }}">
                                                                        <input type="number" min="0" max="20" name="notes[]" placeholder=".../20" class="form-control">
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Soumettre les notes</button>
                                                </div>
                                            </form>
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
