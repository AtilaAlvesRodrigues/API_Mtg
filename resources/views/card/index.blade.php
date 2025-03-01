<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartas de Magic: The Gathering - 10ª Edição</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Incluir Anime.Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

</head>

<body>
    <!-- Container principal -->
    <div class="container">
        <!-- Título da página -->
        <h1 class="text-center mb-4">Cartas de Magic: The Gathering - 10ª Edição</h1>

        <!-- Barra de pesquisa -->
        <div class="search-bar">
          <!-- Search by Name -->
          <input type="text" class="form-control mb-2" id="searchName" placeholder="Pesquisar por Nome da Carta">
          
          <!-- Search by Mana Cost -->
          <input type="text" class="form-control mb-2" id="searchManaCost" placeholder="Pesquisar por Custo de Mana">
          
          <!-- Search by Keyword -->
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

          <!-- Search by Type -->
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
          
          <!-- Search by Color -->
          <select class="form-control mb-2" id="searchColor">
              <option value="">Pesquisar por Cor da Carta</option>
              <option value="w">
                Branco
                <img src="https://www.elfoman.com.br/wp-content/uploads/2018/10/white_mana.png" alt="Branco" style="width: 20px; vertical-align: middle;">
              </option>
              <option value="u">
                Azul
                <img src="https://www.elfoman.com.br/wp-content/uploads/2018/10/blue_mana.png" alt="Azul" style="width: 20px; vertical-align: middle;">
              </option>
              <option value="b">
                Preto
                <img src="https://www.elfoman.com.br/wp-content/uploads/2018/10/black_mana.png" alt="Preto" style="width: 20px; vertical-align: middle;">
              </option>
              <option value="r">
                Vermelho
                <img src="https://www.elfoman.com.br/wp-content/uploads/2018/10/red_mana.png" alt="Vermelho" style="width: 20px; vertical-align: middle;">
              </option>
              <option value="g">
                Verde
                <img src="https://www.elfoman.com.br/wp-content/uploads/2018/10/mana_green-e1659410632434.png" alt="Verde" style="width: 20px; vertical-align: middle;">
              </option>
              <option value="colorless">Incolor</option>
          </select>
        </div>

        <!-- Botão para limpar os campos -->
        <div class="text-center mt-3">
            <button id="clearFilters" class="btn btn-danger">Limpar Filtros</button>
        </div>

        <!-- Container dos cards -->
        <div id="cardContainer" class="card-container">
            <p>E aqui que deveria mostrar as cartas</p>
            <!-- Os cards serão inseridos aqui dinamicamente -->
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <!-- As páginas serão geradas dinamicamente -->
                    <!-- Exemplo: <li class="page-item active"><a class="page-link" href="#" onclick="goToPage(1)">1</a></li> -->
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Popup container -->
    <div class="overlay">
        <div class="popup">
            <button type="button" class="close-button">&times;</button>
            <!-- Card details will be dynamically inserted here -->
        </div>
    </div>

    <!-- Inclui Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Inclui Popper.js (necessário para alguns componentes do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- Link para o arquivo  JavaScript -->
    <script src="js/script.js"></script>
</body>

</html>