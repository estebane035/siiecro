@extends('layouts.auth')

@section('body')

    <div class="middle-box text-center loginscreen ">
        <div>
            <div class="animated fadeInDown">
                <img width="250px" src="img/logo.jpeg">
            </div>
            <br>
            <p>Bienvenidos a la Plataforma de obra intervenida en la ECRO</p>
            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Usuario" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            </form>
            <p class="m-t"> <small>&copy; ECRO {{ date('Y') }} - {{ date('Y',strtotime('4 year')) }}</small> </p>
        </div>
    </div>

@endsection