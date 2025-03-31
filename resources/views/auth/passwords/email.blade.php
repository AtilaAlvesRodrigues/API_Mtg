<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu sua Senha</title>

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

            <!-- Exibe Mensagem de Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        type="email" name="email" value="{{ old('email') }}" required autofocus />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <!-- Botão para enviar o e-mail de recuperação -->
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Enviar Link de Redefinição
                    </button>
                </div>

                <div class="flex items-center justify-end mt-2">
                    <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Já tem uma conta? Faça o login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
