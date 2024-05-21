@extends("layout.app")

<body>

@section("content")

<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <!-- ... other rings ... -->
        </div>
    </div>
</div>
<!-- Pre-loader end -->

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
                                <!-- Page Heading -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="mb-0">{{ $depot->nomDepot }}</h1><br>
                                        <h4>{{ $depot->description }}</h4>
                                    </div>
                                    
                                    <div class="text-right">
                                        Temps restant : <span id="remaining-time-{{ $depot->id }}" class="remaining-time-box"></span>
                                        @php
                                        if (Auth::user()->role_id == 2 && $depot->etat=='fermé') {
                                            echo '<br>';
                                            echo '<a href="' . route('depots.students', $depot) . '" class="btn btn-warning">Notes</a>';
                                        }
                                        @endphp
                                    </div>
                                </div>
                                <hr/>

                                @if(session('message1'))
                                <div id="success-message" class="alert alert-success">
                                    {{ session('message1') }}
                                </div>
                                @endif
                                @if(session('message'))
                                <div id="success-message" class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div id="success-message" class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif

                                @php
                                    $professorEmails = App\Models\Professeur::pluck('emailProfesseur')->toArray();
                                @endphp

                            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <h3 style="text-align: center">Fichiers Soumis</h3><br>
                            @endif
                           
                                <div class="row">
                                    
                                    @foreach($depot->getMedia() as $media)
                                        @if (Auth::user()->role_id == 1)
                                            @if (isset($media->custom_properties['user_email']) && $media->custom_properties['user_email'] == Auth::user()->email)
                                                @php
                                                    $fileName = $media->file_name;
                                                    $startsWithNotes = strpos($fileName, 'notes') === 0;
                                                @endphp
                                                <div class="col-md-4 mb-4">
                                                    <div class="card custom-card">
                                                        <div class="card-body text-center">
                                                            <img src="{{ asset('assets/images/zip.png') }}" style="max-width: 100%; height: 90px;" class="mx-auto d-block">
                                                            <h6 class="card-title mt-3">{{ $fileName }}</h6>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between" style="border-radius: 0 0 50px 50px">
                                                            <a href="{{ route('depot.download', ['id' => $media->id]) }}">
                                                                <i class="ri-folder-download-line"></i>
                                                            </a>
                                                            @if ($depot->etat !== 'fermé')
                                                                <form action="{{ route('depot.delete-file', ['id' => $media->id]) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn-link delete-button border-0">
                                                                        <i class="ri-delete-bin-2-line"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @elseif (Auth::user()->role_id == 2)
                                            @php
                                                $fileName = $media->file_name;
                                                $startsWithNotes = strpos($fileName, 'notes') === 0;
                                            @endphp
                                            @if (!$startsWithNotes)
                                                <div class="col-md-4 mb-4">
                                                    <div class="card custom-card">
                                                        <div class="card-body text-center">
                                                            <img src="{{ asset('assets/images/zip.png') }}" style="max-width: 100%; height: 90px;" class="mx-auto d-block">
                                                            <h6 class="card-title mt-3">{{ $fileName }}</h6>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between" style="border-radius: 0 0 50px 50px">
                                                            <a href="{{ route('depot.download', ['id' => $media->id]) }}">
                                                                <i class="ri-folder-download-line"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 4)
                                <h3 style="text-align: center">Fichiers des notes</h3><br>
                                    <div class="row">
                                        
                                        @foreach($depot->getMedia() as $media)
                                            @php
                                                $fileName = $media->file_name;
                                                $startsWithNotes = strpos($fileName, 'notes') === 0;
                                            @endphp
                                            @if ($startsWithNotes)
                                                <div class="col-md-4 mb-4">
                                                    <div class="card custom-card">
                                                        <div class="card-body text-center">
                                                            <img src="{{ asset('assets/images/zip.png') }}" style="max-width: 100%; height: 90px;" class="mx-auto d-block">
                                                            <h6 class="card-title mt-3">{{ $fileName }}</h6>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between" style="border-radius: 0 0 50px 50px">
                                                            <a href="{{ route('depot.download', ['id' => $media->id]) }}">
                                                                <i class="ri-folder-download-line"></i>
                                                            </a>
                                                            @if (Auth::user()->role_id == 2)
                                                                <form action="{{ route('depot.delete-file', ['id' => $media->id]) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn-link delete-button border-0">
                                                                        <i class="ri-delete-bin-2-line"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                @if ($depot->getMedia()->isEmpty())
                                    <li>Aucun fichier ici</li>
                                @endif

                                @if (Auth::user()->role_id == 1)
                                    @if ($depot->etat !== 'fermé')
                                        @php
                                            $studentFiles = $depot->getMedia()->filter(function ($media) {
                                                $customProperties = $media->getCustomProperty('user_email');
                                                return $customProperties === Auth::user()->email;
                                            });

                                            $studentFilesExist = $studentFiles->isNotEmpty();
                                        @endphp

                                        @if (!$studentFilesExist)
                                            <div id="uploadFormContainer">
                                                <form id="uploadForm" action="{{ route('depots.add-files', $depot) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div id="dropZone" class="drop-zone">
                                                        <label for="fileInput" id="fileInputLabel">Deposez un fichier(.rar, .zip ou .pdf)</label>
                                                        <input type="file" name="fichiers[]" id="fileInput" accept=".zip, .rar, .pdf" multiple>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                @endif

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var successMessage = document.getElementById('success-message');

                                        if (successMessage) {
                                            var timeout = 3000;
                                            setTimeout(function() {
                                                successMessage.style.display = 'none';
                                            }, timeout);
                                        }
                                    });
                                </script>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var dropZone = document.getElementById('dropZone');
                                        var fileInput = document.getElementById('fileInput');
                                        var fileInputLabel = document.getElementById('fileInputLabel');
                                        var uploadForm = document.getElementById('uploadForm');

                                        dropZone.addEventListener('dragover', function(e) {
                                            e.preventDefault();
                                            dropZone.classList.add('drag-over');
                                        });

                                        dropZone.addEventListener('dragleave', function() {
                                            dropZone.classList.remove('drag-over');
                                        });

                                        dropZone.addEventListener('drop', function(e) {
                                            e.preventDefault();
                                            dropZone.classList.remove('drag-over');

                                            var files = e.dataTransfer.files;
                                            fileInput.files = files;
                                            updateFileNameDisplay();

                                            uploadForm.submit();
                                        });

                                        dropZone.addEventListener('click', function() {
                                            fileInput.click();
                                        });

                                        fileInput.addEventListener('change', function() {
                                            updateFileNameDisplay();
                                        });

                                        function updateFileNameDisplay() {
                                            var filenameDisplay = '';
                                            if (fileInput.files.length > 0) {
                                                filenameDisplay = fileInput.files.length > 1 ? fileInput.files.length + ' files selected' : fileInput.files[0].name;
                                            } else {
                                                filenameDisplay = 'Choose a file';
                                            }
                                            fileInputLabel.textContent = filenameDisplay;
                                        }
                                    });
                                </script>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        @if (isset($studentFilesExist))
                                            var studentFilesExist = {{ $studentFilesExist ? 'true' : 'false' }};
                                            var uploadForm = document.getElementById('uploadForm');

                                            if (studentFilesExist) {
                                                uploadForm.style.display = 'none';
                                            }
                                        @endif
                                    });
                                </script>

                                <script>
                                    function updateRemainingTime(depotId) {
                                        var depotClosureDate = new Date('{{ $depot->dateFermeture }}');
                                        var remainingTime = depotClosureDate - new Date();

                                        if (remainingTime <= 0) {
                                            document.getElementById('remaining-time-' + depotId).textContent = 'Expiré';
                                            updateDepotEtat(depotId);
                                        } else {
                                            var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                                            remainingTime -= days * (1000 * 60 * 60 * 24);
                                            var hours = Math.floor(remainingTime / (1000 * 60 * 60));
                                            remainingTime -= hours * (1000 * 60 * 60);
                                            var minutes = Math.floor(remainingTime / (1000 * 60));
                                            remainingTime -= minutes * (1000 * 60);
                                            var seconds = Math.floor(remainingTime / 1000);

                                            document.getElementById('remaining-time-' + depotId).textContent = days + "j " + hours + "h " + minutes + "m " + seconds + "s";
                                        }
                                    }

                                    updateRemainingTime({{ $depot->id }});

                                    setInterval(function() {
                                        updateRemainingTime({{ $depot->id }});
                                    }, 1000);
                                </script>

                                <script>
                                    function updateDepotEtat(depotId) {
                                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                        $.ajax({
                                            url: '/update-depot-etat/' + depotId,
                                            type: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            success: function(response) {
                                                console.log(response);
                                            },
                                            error: function(xhr) {
                                                console.error(xhr.responseText);
                                            }
                                        });
                                    }
                                </script>
                               
                                

                                @if (Auth::user()->role_id == 2)
                                    <div class="floating-button">
                                        <a href="" class="btn btn-success btn-lg">Tout Télécharger</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

</body>
