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
                <?php $emailUser= Auth::user()->email; ?>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">

                                <!-- Page Heading -->
                                <h1 class="mb-0"><?php echo $depot->nomDepot; ?></h1>
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

                                    @foreach($depot->getMedia() as $media)

                                        <li>Fichier :
                                            @if (Auth::user()->role_id == 1)
                                            @if (in_array($media->custom_properties['user_email'], $professorEmails) || $media->custom_properties['user_email'] == Auth::user()->email)
                                            <a href="{{ route('depot.download', ['id' => $media->id]) }}">{{ $media->file_name }}</a>
                                            @else
                                            <a href="">{{ $media->file_name }}</a>
                                            @endif
                                            @elseif (Auth::user()->role_id == 2)
                                            <a href="{{ route('depot.download', ['id' => $media->id]) }}">{{ $media->file_name }}</a>
                                            @endif
                                        </li>
                                    @endforeach

                                    @if ($depot->getMedia()->isEmpty())
                                    <li>Aucun fichier associé</li>
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
                                <form id="uploadForm" action="{{ route('depots.add-files', $depot) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div id="dropZone" class="drop-zone">
                                        <p>Drag & drop files here or click to select</p>
                                        <label for="fileInput" id="fileInputLabel">Choisissez un fichier(.rar, .zip ou .pdf)</label>
                                        <input type="file" name="fichiers[]" id="fileInput" accept=".zip, .rar, .pdf" multiple>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload Files</button>
                                </form>
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
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var dropZone = document.getElementById('dropZone');
                                        var fileInput = document.getElementById('fileInput');
                                        var fileInputLabel = document.getElementById('fileInputLabel');

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

                                @endsection
