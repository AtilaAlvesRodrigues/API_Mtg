<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Carta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card-details-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: 80%;
            max-width: 800px;
            text-align: center;
        }
        .card-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="card-details-container">
        <img id="cardImage" src="" alt="Card Image" class="card-image">
        <h2 id="cardName"></h2>
        <p id="cardType"></p>
        <p id="cardText"></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to extract the scryfallId from the URL
            function getScryfallId() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('scryfallId');
            }

            // Fetch card details by scryfallId using AJAX
            function fetchCardDetails(scryfallId) {
                const apiUrl = `https://api.scryfall.com/cards/${scryfallId}?format=json`;

                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    dataType: 'json',
                    success: function(card) {
                        // Populate the card details on the page
                        $('#cardImage').attr('src', card.image_uris.normal);
                        $('#cardName').text(card.name);
                        $('#cardType').text(card.type_line);
                        $('#cardText').text(card.oracle_text);
                    },
                    error: function(error) {
                        console.error('Error fetching card details:', error);
                        // Display an error message on the page if necessary
                        $('#cardName').text('Failed to load card details.');
                    }
                });
            }

            // Get the scryfallId from the URL
            const scryfallId = getScryfallId();

            // If a scryfallId is available, fetch and display the card details
            if (scryfallId) {
                fetchCardDetails(scryfallId);
            } else {
                // Display a message if no scryfallId is provided
                $('#cardName').text('No card selected.');
            }
        });
    </script>
</body>
</html>