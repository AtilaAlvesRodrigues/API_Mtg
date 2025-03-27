<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartas de Magic: The Gathering - 10ª Edição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <!-- Barra de navegação com Login, Registro e Logout -->
    <div class="container-fluid bg-light py-2">
        <div class="d-flex justify-content-end">
            @guest
                <!-- Para visitantes não autenticados -->
                <a href="/login" class="btn btn-primary me-2">Login</a>
            @endguest

            @auth
                <!-- Para usuários autenticados -->
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
        </div>
    </div>

    <div class="container">
        <h1 class="text-center mb-4">Cartas de Magic: The Gathering - 10ª Edição</h1>

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
                <option value="w">Branco</option>
                <option value="u">Azul</option>
                <option value="b">Preto</option>
                <option value="r">Vermelho</option>
                <option value="g">Verde</option>
                <option value="colorless">Incolor</option>
            </select>

        </div>

        <div class="text-center mt-3">
            <button id="clearFilters" class="btn btn-danger">Limpar Filtros</button>
        </div>

        <div id="cardContainer" class="card-container">
            <div style="position: relative; display: inline-block;">
                <img src="${imageUrl}" class="custom-image" alt="${card.name}">

            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination">
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/main.js"></script>
</body>

</html>
