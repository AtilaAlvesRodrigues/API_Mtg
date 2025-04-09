<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartas de Magic: The Gathering - 10ª Edição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Importmap para carregar o módulo de tema -->
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
</head>

<body>
    <!-- Botão de tema no canto superior esquerdo -->
    <div style="position: absolute; top: 10px; left: 10px;">
        <button id="theme-toggle-btn-top-left" class="btn theme-toggle-trigger" title="Alternar tema"
            style="background: none; border: none; padding: 0; width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
            <!-- Ícone será carregado por theme-toggle.js -->
        </button>
    </div>

    <!-- Botão de login/logout no canto superior direito -->
    <div style="position: absolute; top: 10px; right: 10px;">
        @guest
            <a href="/login" class="btn btn-primary">Login</a>
        @endguest
        @auth
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        @endauth
    </div>

    <div class="container">
        <!-- Logo -->
        <div class="logo-container text-center my-3">
            <a href="/">
                <img src="images/logo_Magic.jpg" alt="Magic: The Gathering Logo" class="img-fluid" />
            </a>
        </div>

        <h1 class="text-center mb-4">Cartas de Magic: The Gathering - 10ª Edição</h1>

        <!-- Barra de pesquisa -->
        <div class="search-bar">
            <input type="text" class="form-control mb-2" id="searchName" placeholder="Pesquisar por Nome da Carta">
            <input type="text" class="form-control mb-2" id="searchManaCost"
                placeholder="Pesquisar por Custo de Mana">

            <select class="form-control mb-2" id="searchKeyword">
                <option value="">Pesquisar por Palavra-chave</option>
                <option value="Deathtouch">Deathtouch</option>
                <option value="Defender">Defender</option>
                <option value="Double Strike">Double Strike</option>
                <option value="Equip">Equip</option>
                <option value="First strike">First strike</option>
                <option value="Flash">Flash</option>
                <option value="Flying">Flying</option>
                <option value="Haste">Haste</option>
                <option value="Hexproof">Hexproof</option>
                <option value="Indestructible">Indestructible</option>
                <option value="Lifelink">Lifelink</option>
                <option value="Menace">Menace</option>
                <option value="Protection">Protection</option>
                <option value="Reach">Reach</option>
                <option value="Trample">Trample</option>
                <option value="Vigilance">Vigilance</option>
                <option value="Ward">Ward</option>
            </select>

            <select class="form-control mb-2" id="searchType">
                <option value="">Pesquisar por Tipo da Carta</option>
                <option value="Artifact">Artefato</option>
                <option value="Creature">Criatura</option>
                <option value="Enchantment">Encantamento</option>
                <option value="Sorcery">Feitiço</option>
                <option value="Instant">Mágica Instantânea</option>
                <option value="Planeswalker">Planeswalker</option>
                <option value="Land">Terreno</option>
            </select>

            <select class="form-control mb-2" id="searchColor">
                <option value="">Pesquisar por Cor da Carta</option>
                <option value="w">Branco 🟡</option>
                <option value="u">Azul 🔵</option>
                <option value="b">Preto ⚫</option>
                <option value="r">Vermelho 🔴</option>
                <option value="g">Verde 🟢</option>
                <option value="colorless">Incolor ⚪</option>
            </select>
        </div>

        <div class="text-center mt-3">
            <button id="clearFilters" class="btn btn-danger">Limpar Filtros</button>
        </div>

        <div id="cardContainer" class="card-container mt-4">
            <!-- Cards serão inseridos aqui via JS -->
        </div>

        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination"></ul>
            </nav>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/main.js"></script>
</body>

</html>
