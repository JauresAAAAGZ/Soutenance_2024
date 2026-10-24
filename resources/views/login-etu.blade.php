@extends('layout.app')

@section('content')
<main class="ef-login">
    <div>
        <div class="ef-login-card">
            <img src="{{ asset('assets/images/logos12.png') }}" alt="Edu-Flow" class="ef-login-logo">

            <h1>Connexion</h1>
            <p class="ef-login-subtitle">Accédez à votre espace de dépôt avec votre adresse email.</p>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="password">Mot de passe</label>
                        @if (Route::has('password.request'))
                            <a class="ef-login-forgot" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>

        <p class="ef-login-footer">Edu-Flow · Dépôt et suivi des travaux étudiants</p>
    </div>
</main>
@endsection
