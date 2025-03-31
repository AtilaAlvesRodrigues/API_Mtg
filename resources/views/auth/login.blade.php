<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="mb-6">
            <!-- Logo Magic: The Gathering -->
            <a href="/">
                <img src="images/magic-logo.png" alt="Magic: The Gathering Logo"
                    class="w-40 h-auto mx-auto bg-transparent object-contain opacity-80 hover:opacity-100 hover:shadow-2xl transition duration-300 ease-in-out">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        type="email" name="email" value="{{ old('email') }}" required autofocus />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input id="password"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-600">Lembrar de mim</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <!-- Botão Criar Conta alinhado à esquerda -->
                    <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Criar conta
                    </a>

                    <!-- Botão Entrar alinhado à direita -->
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Entrar
                    </button>
                </div>

                <div class="flex items-center justify-end mt-2">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            Esqueceu sua senha?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

</body>

</html>
