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
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
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
                                        <h1 class="mb-0"><?php echo $depot->nomDepot; ?></h1><br>
                                        <h4><?php echo $depot->description; ?></h4>
                                    </div>
                                    
                                    <div class="text-right">
                                        Temps restant : <span id="remaining-time-{{ $depot->id }}" class="remaining-time-box"></span>
                                    </div>
                                </div>
                                <hr />
                                @if(session('message1'))
                                <div id="success-message" class="alert alert-success">
                                    {{ session('message1') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div id="success-message" class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <ul>
                                    @php
                                    $professorEmails = App\Models\Professeur::pluck('emailProfesseur')->toArray();
                                    @endphp

<div class="row">
    @foreach($depot->getMedia() as $media)
    @if (Auth::user()->role_id == 1)
     @if ($media->custom_properties['user_email'] == Auth::user()->email)
     <div class="col-md-4 mb-4">
    <div class="card custom-card">
        <div class="card-body text-center"> <!-- Ajoutez la classe text-center pour centrer le contenu -->
            <!-- Ajouter l'image ici -->
            <img src="{{ asset('assets/images/zip.png') }}" style="max-width: 100%; height: 90px;" class="mx-auto d-block"> <!-- Ajoutez les classes mx-auto et d-block pour centrer l'image -->
            <h6 class="card-title mt-3">{{ $media->file_name }}</h6> <!-- Ajoutez la classe mt-3 pour décaler le nom du fichier d'une ligne -->
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
                    <div class="col-md-4 mb-4">
    <div class="card custom-card">
        <div class="card-body text-center"> <!-- Ajoutez la classe text-center pour centrer le contenu -->
            <!-- Ajouter l'image ici -->
            <img src="{{ asset('assets/images/zip.png') }}" style="max-width: 100%; height: 90px;" class="mx-auto d-block"> <!-- Ajoutez les classes mx-auto et d-block pour centrer l'image -->
            <h6 class="card-title mt-3">{{ $media->file_name }}</h6> <!-- Ajoutez la classe mt-3 pour décaler le nom du fichier d'une ligne -->
        </div>
        <div class="card-footer d-flex justify-content-between" style="border-radius: 0 0 50px 50px">
        <a href="{{ route('depot.download', ['id' => $media->id]) }}">
            <i class="ri-folder-download-line"></i>
        </a>
                    </div>
                </div>
            </div>
        @endif
              
    @endforeach
</div>

                                    @if ($depot->getMedia()->isEmpty())
                                    <li>Aucun fichier ici</li>
                                    @endif
                                </ul>

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
                                            // Set the timeout in milliseconds (e.g., 5000ms = 5 seconds)
                                            var timeout = 3000;

                                            // Automatically dismiss the success message after the timeout
                                            setTimeout(function() {
                                                successMessage.style.display = 'none'; // Hide the message
                                            }, timeout);
                                        }
                                    });
                                </script>

                                <script>
                                  // JavaScript code

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

                                // Automatically submit the form
                                uploadForm.submit();
                            });

                            // Allow users to click to select files
                            dropZone.addEventListener('click', function() {
                                fileInput.click();
                            });

                            // Update the displayed file name when a file is selected
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
                                    <?php if (isset($studentFilesExist)): ?>
                                        var studentFilesExist = <?php echo $studentFilesExist ? 'true' : 'false'; ?>;
                                        var uploadForm = document.getElementById('uploadForm');

                                        if (studentFilesExist) {
                                            uploadForm.style.display = 'none';
                                        }
                                    <?php endif; ?>
                                });

                                </script>
                                
    <script>
    
      function updateRemainingTime(depotId) {
        var depotClosureDate = new Date('<?php echo $depot->dateFermeture; ?>');
        var remainingTime = depotClosureDate - new Date();

        if (remainingTime <= 0) {
            document.getElementById('remaining-time-' + depotId).textContent = 'Expiré';
            
            // Call the function to update the depot's etat
            updateDepotEtat(depotId);
        } else {
            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            remainingTime -= days * (1000 * 60 * 60 * 24);
            var hours = Math.floor(remainingTime / (1000 * 60 * 60));
            remainingTime -= hours * (1000 * 60 * 60);
            var minutes = Math.floor(remainingTime / (1000 * 60));
            remainingTime -= minutes * (1000 * 60);
            var seconds = Math.floor(remainingTime / 1000);

            // Update the displayed remaining time
            document.getElementById('remaining-time-' + depotId).textContent = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
        }
    }

    // Update the remaining time for the depot
    updateRemainingTime(<?php echo $depot->id; ?>);

    // Update the remaining time every second
    setInterval(function() {
        updateRemainingTime(<?php echo $depot->id; ?>);
    }, 1000);


</script>

    <script>
       // Function to update the état of the dépôt to "fermé"
       function updateDepotEtat(depotId) {
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Send an Ajax request to update the état of the dépôt
        $.ajax({
            url: '/update-depot-etat/' + depotId,
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
        },

            success: function(response) {
                // Handle success response if needed
                console.log(response);
            },
            error: function(xhr) {
                // Handle error response if needed
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
 @endsection

 </body>