<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cartas de Magic: The Gathering - 10ª Edição</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .card { background: white; border: 1px solid #ccc; padding: 15px; margin: 10px; border-radius: 8px; display: inline-block; width: 200px; }
        .card img { width: 100%; height: auto; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Cartas de Magic: The Gathering - 10ª Edição</h1>
    <div id="cards"></div>

    <script>
        fetch('/api/mtg/cards')
            .then(response => response.json())
            .then(data => {
                const cardsContainer = document.getElementById('cards');
                data.forEach(card => {
                    const cardElement = document.createElement('div');
                    cardElement.className = 'card';

                    cardElement.innerHTML = `
                        <h3>${card.name}</h3>
                        ${card.imageUrl ? `<img src="${card.imageUrl}" alt="${card.name}">` : ''}
                        <p><strong>Tipo:</strong> ${card.type}</p>
                        <p><strong>Raridade:</strong> ${card.rarity}</p>
                        <p><strong>Custo de Mana:</strong> ${card.manaCost || 'N/A'}</p>
                    `;

                    cardsContainer.appendChild(cardElement);
                });
            })
            .catch(error => console.error('Erro ao carregar as cartas:', error));
    </script>
</body>
</html>
