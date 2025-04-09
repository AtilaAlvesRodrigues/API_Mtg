<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Magic: The Gathering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container login-container">
        <div class="logo-container text-center">
            <button id="theme-toggle-btn" class="btn theme-toggle-trigger theme-toggle-btn-login" title="Toggle theme">
                <!-- SVG icon will be loaded by theme-toggle.js -->
            </button>
            <a href="/">
                <img src="images/logo_Magic.jpg" alt="Magic: The Gathering Logo" class="login-logo mb-4">
            </a>
        </div>

<<<<<<< HEAD
        <div class="login-form-container">
=======
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Mensans de erros -->
            <!-- Exibe Erros de Validação -->
            @if ($errors->any())
                <div class="mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Exibe Mensagem de Sessão -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Mensagem de erro para credenciais não correspondentes -->
            @if ($errors->has('email') && $errors->first('email') == 'These credentials do not match our records.')
                <div class="mb-4 font-medium text-sm text-red-600">
                    {{ $errors->first('email') }}
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('register') }}">
                        <button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Criar uma conta
                        </button>
                    </a>
                </div>
            @endif
            
            <!-- METHODO POST aqui -->
>>>>>>> 3e05e89031587f60c39a17a91382199ede54815c
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value=""
                        value="{{ old('email') }}" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label" {{ old('remember') ? 'checked' : '' }}>
                    </label>
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <!-- Botão Criar Conta alinhado à esquerda -->
                    <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Criar conta
                    </a>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="link-light text-decoration-underline small" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>

                    <!-- Botão Entrar alinhado à direita -->
                    <button type="submit" class="btn btn-primary ms-4">
                        Log in
                    </button>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script type="importmap">
    {
      "imports": {
        "theme-toggle": "./js/theme-toggle.js"
      }
    }
    </script>
    <script type="module">
        import 'theme-toggle';
    </script>
</body>

</html>
