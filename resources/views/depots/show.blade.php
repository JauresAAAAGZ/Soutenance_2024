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
        <h1 class="mb-0">Depot</h1>
        <hr/>
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
            @foreach($depot->getMedia() as $media)
            <li>Fichier :
                @if (Auth::user()->role_id==1)
                        @if ($media->custom_properties['user_email'] == Auth::user()->email)
                        <a href="{{ route('depot.download', ['id' => $media->id]) }}">
                        @else
                        <a href="">
                        @endif

                        {{ $media->file_name }}</a></li>

                @elseif (Auth::user()->role_id==2)
                <a href="{{ route('depot.download', ['id' => $media->id]) }}">
                    {{ $media->file_name }}</a></li>
                @endif
            
            @endforeach

            @if ($depot->getMedia()->isEmpty())
                <li>Aucun fichier associé</li>
            @endif
        </ul>

        @if (Auth::user()->role_id == 1)
            @if ($depot->etat !== 'fermé')
                <form action="{{ route('depots.add-files', $depot) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="fichiers[]" accept=".zip, .rar, .pdf" multiple>
                    <button type="submit" class="btn btn-primary">Ajouter des Fichiers</button>
                </form>
            @endif
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var successMessage = document.getElementById('success-message');

                if (successMessage) {
                    // Set the timeout in milliseconds (e.g., 5000ms = 5 seconds)
                    var timeout = 3000;

                    // Automatically dismiss the success message after the timeout
                    setTimeout(function () {
                        successMessage.style.display = 'none'; // Hide the message
                    }, timeout);
                }
            });
        </script>

@endsection

