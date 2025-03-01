$(document).ready(function () {
    console.log("O script JavaScript está carregado e funcionando!");
    let currentPage = 1;
    const cardsPerPage = 16;
    let allCards = [];
    const cardContainer = $("#cardContainer");
    const pagination = $("#pagination");
    const searchNameInput = $("#searchName");
    const searchTypeInput = $("#searchType");
    const searchManaCostInput = $("#searchManaCost");
    const searchColorInput = $("#searchColor");
    const searchKeywordInput = $("#searchKeyword");
  
    // URL da API
    const apiUrl = "https://mtgjson.com/api/v5/10E.json";
  
    // Include anime.js library from CDN
    const animeCDN = document.createElement('script');
    animeCDN.src = 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js';
    animeCDN.type = 'text/javascript';
    document.head.appendChild(animeCDN);
  
    // Função para buscar as cartas
    function fetchCards() {
      $.ajax({
        url: apiUrl,
        method: "GET",
        dataType: "json", // Especifica o tipo de dado esperado
        success: function (data) {
          console.log("Resposta da API:", data);
  
          if (data && data.data && data.data.cards) {
            allCards = data.data.cards;
            displayCards(allCards); 
          } else {
            console.error("Estrutura de dados inesperada:", data);
            cardContainer.html(
              "<p class='text-center text-danger'>Erro ao carregar cartas. Dados inesperados.</p>"
            );
          }
        },
        error: function (error) {
          console.error("Erro ao buscar cartas:", error);
          cardContainer.html(
            "<p class='text-center text-danger'>Erro ao carregar cartas.</p>"
          );
        },
      });
    }
  
    // Função para exibir as cartas 
    function displayCards(cards) {
      cardContainer.empty();
  
      const searchTermName = searchNameInput.val().toLowerCase();
      const searchTermType = searchTypeInput.val().toLowerCase();
      const searchTermManaCost = searchManaCostInput.val().toLowerCase();
      const searchTermColor = searchColorInput.val().toLowerCase();
  
      // Filtra as cartas pela pesquisa
      const filteredCards = cards.filter((card) => {
        if (!card) return false;
  
        const nameMatch = !searchTermName || (card.name && card.name.toLowerCase().includes(searchTermName));
        const typeMatch = !searchTermType || (card.type && card.type.toLowerCase().includes(searchTermType));
        const manaCostMatch = !searchTermManaCost || (card.manaValue != null && card.manaValue.toString() === searchTermManaCost);
        
        // Search by colorIdentity
        let colorIdentityMatch = false;
  
        if (searchTermColor === "colorless") {
          // Check if colorIdentity is an empty array for colorless cards
          colorIdentityMatch = card.colorIdentity && card.colorIdentity.length === 0;
        } else {
          // Check if the colorIdentity array contains the search term color
          colorIdentityMatch = !searchTermColor || (card.colorIdentity && card.colorIdentity.some((color) => color.toLowerCase().includes(searchTermColor)));
        }
  
        const searchTermKeyword = searchKeywordInput.val().toLowerCase();
        const keywordMatch = !searchTermKeyword || (card.text && card.text.toLowerCase().includes(searchTermKeyword));
  
        return nameMatch && typeMatch && manaCostMatch && colorIdentityMatch && keywordMatch;
      });
  
      if (filteredCards.length === 0) {
        cardContainer.html(
          "<p class='text-center text-danger'>Nenhuma carta encontrada para a pesquisa.</p>"
        );
        updatePagination(0);
        return;
      }
  
      const startIndex = (currentPage - 1) * cardsPerPage;
      const endIndex = startIndex + cardsPerPage;
      const paginatedCards = filteredCards.slice(startIndex, endIndex);
      const defaultImageUrl = "URL_TO_DEFAULT_IMAGE";
  
      // Function to load image with error handling
      const loadImage = (card, cardElement) => {
        let imageUrl = defaultImageUrl; 
        let imageLoadError = false;
  
        if (card.identifiers && card.identifiers.scryfallId) {
          imageUrl = `https://api.scryfall.com/cards/${card.identifiers.scryfallId}?format=image`;
        } else {
          console.warn(
            `Scryfall ID not found for card: ${card.name}. Using default image.`
          );
          imageUrl = defaultImageUrl;
          imageLoadError = true;
        }
  
        const img = $("<img>")
          .attr("src", imageUrl)
          .addClass(`card-img-top ${imageLoadError ? "error" : ""}`)
          .attr("alt", card.name)
          .on("error", function () {
            $(this).attr("src", defaultImageUrl).addClass("error");
          });
  
        const cardImgContainer = $("<div>").addClass("card-img-container");
        cardImgContainer.append(img);
  
        const cardLink = $("<a>")
          .attr(
            "href",
            `card.html?name=${encodeURIComponent(card.name)}`
          )
          .attr("target", "_blank") 
          .append(cardImgContainer);
  
        cardElement.append(cardLink); 
      };
  
      paginatedCards.forEach((card, index) => {
        const cardElement = $("<div>").addClass("card").css({ opacity: 0, transform: 'scale(0.8)' }); // Initial CSS for animation
        loadImage(card, cardElement);
        cardContainer.append(cardElement);
  
        cardElement.on("click", function(e) {
          e.preventDefault();
          openCardPopup(card);
        });
  
        anime({
          targets: cardElement[0],
          opacity: 1,
          scale: 1,
          duration: 500,
          delay: index * 50,
          easing: 'easeOutQuad'
        });
      });
  
      updatePagination(filteredCards.length);
    }
  
    function openCardPopup(card) {
      const overlay = $("<div class='overlay active'></div>");
      const popup = $("<div class='popup'></div>").css({ opacity: 0, transform: 'scale(0.8)' });
      const closeButton = $("<button type='button' class='close-button'>&times;</button>");
  
      const cardImageContainer = $("<div class='card-image-container'></div>");
      const cardImage = $("<img>").attr("src", `https://api.scryfall.com/cards/${card.identifiers.scryfallId}/?format=image`).attr("alt", card.name);
      cardImageContainer.append(cardImage);
      popup.append(cardImageContainer);
  
      const cardDetails = $("<div class='card-details'></div>");
      cardDetails.append(`<h2>${card.name}</h2>`);
      cardDetails.append(`<p><strong>Type:</strong> ${card.type}</p>`);
      cardDetails.append(`<p><strong>Text:</strong> ${card.text || 'N/A'}</p>`);
      popup.append(cardDetails);
  
      popup.append(closeButton);
      overlay.append(popup);
      $("body").append(overlay);
  
      anime({
        targets: popup[0],
        opacity: 1,
        scale: 1,
        duration: 300,
        easing: 'easeOutQuad'
      });
  
      closeButton.on("click", function () {
        anime({
          targets: popup[0],
          opacity: 0,
          scale: 0.8,
          duration: 200,
          easing: 'easeInQuad',
          complete: function(){
            overlay.removeClass("active");
            overlay.remove();
          }
        });
      });
  
      overlay.on("click", function (event) {
        if (event.target === this) {
          anime({
            targets: popup[0],
            opacity: 0,
            scale: 0.8,
            duration: 200,
            easing: 'easeInQuad',
            complete: function(){
              overlay.removeClass("active");
              overlay.remove();
            }
          });
        }
      });
    }
  
    // Função para atualizar a paginação
    function updatePagination(totalCards) {
      const totalPages = Math.ceil(totalCards / cardsPerPage);
      let paginationHtml = "";
  
      paginationHtml += `<li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                  <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                  </a>
              </li>`;
  
      let startPage = Math.max(1, currentPage - 5);
      let endPage = Math.min(totalPages, currentPage + 4);
  
      if (totalPages <= 10) {
        // Mostra todas as páginas se houver 10 ou menos
        for (let i = 1; i <= totalPages; i++) {
          paginationHtml += `<li class="page-item ${
            i === currentPage ? "active" : ""
          }">
                  <a class="page-link page-number" href="#" data-page="${i}">${i}</a>
              </li>`;
        }
      } else {
        // Se houver mais de 10 páginas
        if (currentPage > 6) {
          // Adiciona "..." no início se não estiver perto da primeira página
          paginationHtml += `<li class="page-item"><a class="page-link more-pages" href="#" data-page="1">1</a></li>`;
          if(currentPage > 7){
              paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
          }
          
        }
  
        for (let i = startPage; i <= endPage; i++) {
          paginationHtml += `<li class="page-item ${
            i === currentPage ? "active" : ""
          }">
                  <a class="page-link page-number" href="#" data-page="${i}">${i}</a>
              </li>`;
        }
  
        if (currentPage + 5 < totalPages) {
          // Adiciona "..." no final se não estiver perto da última página
          if(currentPage + 6 < totalPages){
              paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
          }
          paginationHtml += `<li class="page-item"><a class="page-link more-pages" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
        }
      }
  
      paginationHtml += `<li class="page-item ${
        currentPage === totalPages || totalPages === 0 ? "disabled" : ""
      }">
                  <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                  </a>
              </li>`;
  
      pagination.html(paginationHtml);
    }
  
    // Function to set background color based on selected color
    function setBackgroundColor(color) {
      let backgroundColor = "";
  
      switch (color) {
        case "w":
          backgroundColor = "#efe2d1"; // Light beige for white - Increased contrast
          break;
        case "u":
          backgroundColor = "#b7d7e8"; // Light blue for blue - Increased contrast
          break;
        case "b":
          backgroundColor = "#b0b0b0"; // Light grey for black - Increased contrast
          break;
        case "r":
          backgroundColor = "#e6c0c0"; // Light red for red - Increased contrast
          break;
        case "g":
          backgroundColor = "#c6e3bd"; // Light green for green - Increased contrast
          break;
        case "colorless":
          backgroundColor = "#d3d3d3"; // Light grey for colorless
          break;
        default:
          backgroundColor = "#d3d3d3"; // Default to grey
          break;
      }
  
      $("body").css("background-color", backgroundColor);
    }
  
    // Clear filters button functionality
    $("#clearFilters").on("click", function () {
      searchNameInput.val("");
      searchTypeInput.val("");
      searchManaCostInput.val("");
      searchColorInput.val("");
      searchKeywordInput.val("");
  
      setBackgroundColor(""); // Reset background color to default
      currentPage = 1;
      displayCards(allCards); // Redisplay cards to show all cards
    });
  
    pagination.on("click", ".page-number", function (e) {
      e.preventDefault();
      const pageNumber = parseInt($(this).data("page"));
      goToPage(pageNumber);
    });
  
    pagination.on("click", ".more-pages", function (e) {
      e.preventDefault();
      const pageNumber = parseInt($(this).data("page"));
      goToPage(pageNumber);
    });
  
    function goToPage(pageNumber) {
      currentPage = pageNumber;
      displayCards(allCards); 
    }
  
    searchNameInput.on("keyup", function () {
      currentPage = 1;
      displayCards(allCards); 
    });
  
    searchTypeInput.on("change", function () {
      currentPage = 1;
      displayCards(allCards); 
    });
  
    searchManaCostInput.on("keyup", function () {
      currentPage = 1;
      displayCards(allCards); 
    });
  
    searchColorInput.on("change", function () {
      currentPage = 1;
      const selectedColor = $(this).val(); // Get selected color
      setBackgroundColor(selectedColor); // Set background color
      displayCards(allCards);
    });
  
    searchKeywordInput.on("change", function () {
      currentPage = 1;
      displayCards(allCards);
    });
  
    fetchCards();
  
    // Set initial background color to grey
    setBackgroundColor("");
  });