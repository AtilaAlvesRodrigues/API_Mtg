<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cartas de Magic: The Gathering - 10ª Edição</title>
</head>
<body>
    <h1>Cartas de Magic: The Gathering - 10ª Edição</h1>
    <div id="cards">Carregando cartas...</div>

    <script>
        fetch('/api/mtg/cards')
            .then(response => response.json())
            .then(data => {
                const cardsContainer = document.getElementById('cards');
                cardsContainer.innerHTML = '';  // Limpa o "Carregando..."

                if (data.length === 0) {
                    cardsContainer.innerHTML = 'Nenhuma carta encontrada.';
                    return;
                }

                data.forEach(card => {
                    const cardElement = document.createElement('div');
                    cardElement.innerHTML = `
                        <h3>${card.name}</h3>
                        <p><strong>Tipo:</strong> ${card.type}</p>
                        <p><strong>Raridade:</strong> ${card.rarity}</p>
                        <p><strong>Custo de Mana:</strong> ${card.manaCost || 'N/A'}</p>
                    `;
                    cardsContainer.appendChild(cardElement);
                });
            })
            .catch(error => {
                console.error('Erro ao carregar as cartas:', error);
                document.getElementById('cards').innerHTML = 'Erro ao carregar as cartas.';
            });
    </script>
</body>
</html>

