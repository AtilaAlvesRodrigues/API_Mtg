<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Verificação de E-mail Interativo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="email-container">
        <div class="logo">
            <img src="{{ asset('images/logo_magic.png') }}" alt="Logo Magic" style="max-width: 150px;">
        </div>
        <h2>Confirmação de E-mail</h2>
        <p>Olá <span id="userName">usuário</span>,</p>
        <p>Obrigado por se cadastrar no nosso serviço! Clique no botão abaixo para confirmar seu endereço de e-mail e
            começar a aproveitar todos os benefícios que oferecemos:</p>

        <p style="text-align: center;">
            <a href="#" class="verify-button" onclick="verifyEmail()">Verificar E-mail</a>
        </p>

        <p style="color: #666;">Se você não se registrou, ignore este e-mail. Caso contrário, entre em contato conosco
            para assistência.</p>
        <div class="footer">© <span id="year">2024</span> SuaEmpresa. Todos os direitos reservados.</div>
    </div>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();

        function verifyEmail() {
            alert('E-mail verificado com sucesso! Obrigado por se juntar à nossa comunidade.');
        }

        // Simulate setting the user name (replace with actual user data)
        document.getElementById('userName').textContent = 'João';
    </script>

</body>

</html>