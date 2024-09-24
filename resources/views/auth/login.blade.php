<!DOCTYPE html>
<html lang="es">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PDVSA | Login</title>
    <meta name="description" content="CoreUI Template - InfyOm Laravel Generator">
    <!-- <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard"> -->

    @include('layout.head')

</head>

<body class="container-main-login ">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-12 col-lg-6">
                <div class="container-login p-5">
                    <div class="col-9 mx-auto d-block">
                        <img class="img-fluid mt-3" width="200px" src="{{ asset('iconos/PDVSA-logo-vector-01.webp') }}">
                    </div>
                    <form class="mt-4 pt-2 needs-validation" method="post" action="{{ url('/login') }}">
                        @csrf
                        <div class="mb-3">
                            @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                            <label for="username" class="form-label">Email</label>
                            <input type="text"
                                class="form-control round p-3 {{ $errors->has('rif') ? 'is-invalid' : '' }}"
                                name="email" value="{{ old('rif') }}" placeholder="  Ingrese Email">

                            {{-- @if ($errors->has('userLogin'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('userLogin') }}</strong>
                                </span>
                            @endif --}}
                        </div>
                        <div class="mb-4 mt-3">
                            <label class="form-label mt-3">Contraseña</label>
                            <input type="password"
                                class="form-control round p-3 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="  Introducir contraseña" name="password" id="password">
                            <button type="button" class="btn btn-link mt-1" id="mostrar-contrasena">
                                <span class="fas fa-eye"></span>
                            </button>
                            <span>Mostrar contraseña</span>

                            {{-- @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif --}}
                        </div>
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-between">
                                <div class="form-check lado">
                                    <input class="form-check-input" type="checkbox" id="remember"
                                        value=" old('remember') ? 'checked' : '' }}">
                                    <label class="form-check-label" for="remember">
                                        Recordar
                                    </label>
                                </div>
                                <div class="">
                                    <div class="centro">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-dark">¿Olvidaste tu
                                                contraseña?</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 round px-3 bold" type="submit"> Iniciar
                                sesión</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <!-- CoreUI and necessary plugins-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>

        <script>
            $(document).ready(function() {  
                $('#mostrar-contrasena').click(function() {
                    var tipo = $('#password').attr('type');
                    if (tipo === 'password') {
                        $('#password').attr('type', 'text');
                    } else {
                        $('#password').attr('type', 'password');
                    }
                });
            });
        </script>

</body>

</html>
