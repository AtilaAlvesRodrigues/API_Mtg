<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cartas de Magic: The Gathering - 10ª Edição</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="custom.css">
</head>
<body class="bg-light py-4">
    <div class="container">
        <h1 class="text-center mb-4">Cartas de Magic: The Gathering - 10ª Edição</h1>
        <div id="cards" class="row justify-content-center"></div>
    </div>

    <script>
        fetch('/api/mtg/cards')
            .then(response => response.json())
            .then(data => {
                const cardsContainer = document.getElementById('cards');
                data.forEach(card => {
                    const cardElement = document.createElement('div');
                    cardElement.className = 'col-md-3 mb-4';

                    cardElement.innerHTML = `
                        <div class="card shadow-sm card-custom">
                            ${card.imageUrl ? `<img src="${card.imageUrl}" class="card-img-top" alt="${card.name}">` : ''}
                            <div class="card-body">
                                <h5 class="card-title">${card.name}</h5>
                                <p class="card-text"><strong>Tipo:</strong> ${card.type}</p>
                                <p class="card-text"><strong>Raridade:</strong> ${card.rarity}</p>
                                <p class="card-text"><strong>Custo de Mana:</strong> ${card.manaCost || 'N/A'}</p>
                            </div>
                        </div>
                    `;

                    cardsContainer.appendChild(cardElement);
                });
            })
            .catch(error => console.error('Erro ao carregar as cartas:', error));
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  