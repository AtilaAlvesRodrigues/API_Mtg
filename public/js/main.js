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
    const apiUrl = "https://mtgjson.com/api/v5/10E.json";
    const defaultImageUrl = "URL_TO_DEFAULT_IMAGE"; // Certifique-se de ter uma imagem padrão
    // Define mana colors for background override. Use CSS var for default.
    const manaBgColors = {
        w: "#efe2d1",
        u: "#b7d7e8",
        b: "#b0b0b0",
        r: "#e6c0c0",
        g: "#c6e3bd",
        colorless: "var(--default-bg-color)", // Ensure colorless maps to default
    };

    // Carregar anime.js apenas se necessário
    const animeCDN = document.createElement("script");
    animeCDN.src =
        "https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js";
    animeCDN.type = "text/javascript";

    animeCDN.onload = () => {
        fetchCards();
    };
    document.head.appendChild(animeCDN);

    let hasShownImageLoadError = false;

    function fetchCards() {
        $.ajax({
            url: apiUrl,
            method: "GET",
            dataType: "json",
            success: function (data) {
                console.log("Resposta da API:", data);

                if (data && data.data && data.data.cards) {
                    allCards = data.data.cards;
                    // Ensure default background is applied on initial load
                    $("body").css("background-color", ""); // Let CSS var take effect
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

    function displayCards(cards) {
        cardContainer.empty();

        const searchTermName = searchNameInput.val().toLowerCase();
        const searchTermType = searchTypeInput.val().toLowerCase();
        const searchTermManaCost = searchManaCostInput.val().toLowerCase();
        const searchTermColor = searchColorInput.val().toLowerCase();
        const searchTermKeyword = searchKeywordInput.val().toLowerCase();

        const filteredCards = cards.filter((card) => {
            if (!card) return false;

            const nameMatch =
                !searchTermName ||
                (card.name && card.name.toLowerCase().includes(searchTermName));
            const typeMatch =
                !searchTermType ||
                (card.type && card.type.toLowerCase().includes(searchTermType));
            const manaCostMatch =
                !searchTermManaCost ||
                (card.manaValue != null &&
                    card.manaValue.toString().includes(searchTermManaCost));

            let colorIdentityMatch = false;

            // Handle colorless filter specifically
            if (searchTermColor === "colorless") {
                // Match cards with NO color identity
                colorIdentityMatch =
                    !card.colorIdentity || card.colorIdentity.length === 0;
            } else if (searchTermColor) {
                // Match cards that include the selected color identity
                colorIdentityMatch =
                    card.colorIdentity &&
                    card.colorIdentity.some(
                        (color) => color.toLowerCase() === searchTermColor
                    );
            } else {
                // No color filter applied
                colorIdentityMatch = true;
            }

            const keywordMatch =
                !searchTermKeyword ||
                (card.text &&
                    card.text.toLowerCase().includes(searchTermKeyword));

            return (
                nameMatch &&
                typeMatch &&
                manaCostMatch &&
                colorIdentityMatch &&
                keywordMatch
            );
        });

        if (filteredCards.length === 0) {
            cardContainer.html(
                "<p class='text-center text-info'>Nenhuma carta encontrada para a pesquisa.</p>" // Use text-info for better visibility
            );
            updatePagination(0);
            return;
        }

        const startIndex = (currentPage - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;
        const paginatedCards = filteredCards.slice(startIndex, endIndex);

        paginatedCards.forEach((card, index) => {
            const cardElement = $("<div>")
                .addClass("card")
                .css({ opacity: 0, transform: "scale(0.8)" }); // Initial CSS for animation
            const imageUrl = card.identifiers?.scryfallId
                ? `https://api.scryfall.com/cards/${card.identifiers.scryfallId}/?format=image`
                : defaultImageUrl;

            const img = $("<img>")
                .attr("src", imageUrl)
                .addClass("card-img-top")
                .attr("alt", card.name);

            img.on("load", function () {
                // Image loaded successfully
            });

            img.on("error", function () {
                $(this).off("error").attr("src", defaultImageUrl);
                // If image fails to load, display card name
                cardElement.text(card.name);
                cardElement.css({
                    display: "flex",
                    "justify-content": "center",
                    "align-items": "center",
                    "font-size": "1em",
                    "font-weight": "bold",
                    color: "#aaa", // Lighter text for placeholder
                    "text-align": "center",
                    "min-height": "150px", // Give it some height
                    "background-color": "#444", // Darker placeholder background
                    border: "1px solid #666",
                });

                if (!hasShownImageLoadError) {
                    Swal.fire({
                        title: "Erro ao Carregar Imagens",
                        text: "Houve um problema ao carregar as imagens das cartas. Por favor, verifique sua conexão com a internet ou tente novamente mais tarde.",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                    hasShownImageLoadError = true;
                }
            });

            const cardImgContainer = $("<div>")
                .addClass("card-img-container")
                .append(img);
            cardElement.append(cardImgContainer);

            cardElement.on("click", (e) => {
                e.preventDefault();
                openCardPopup(card);
            });

            anime({
                targets: cardElement[0],
                opacity: 1,
                scale: 1,
                duration: 500,
                delay: index * 50,
                easing: "easeOutQuad",
            });

            cardContainer.append(cardElement);
        });

        updatePagination(filteredCards.length);
    }

    function updatePagination(totalCards) {
        const totalPages = Math.ceil(totalCards / cardsPerPage);
        let paginationHtml = "";

        const createPageItem = (
            page,
            text,
            className = "",
            disabled = false
        ) => {
            return `<li class="page-item ${className} ${
                disabled ? "disabled" : ""
            }">
                <a class="page-link" href="#" data-page="${page}">${text}</a>
            </li>`;
        };

        paginationHtml += createPageItem(
            currentPage - 1,
            "&laquo;",
            "",
            currentPage === 1
        );

        let startPage = Math.max(1, currentPage - 5);
        let endPage = Math.min(totalPages, currentPage + 4);

        if (totalPages <= 10) {
            for (let i = 1; i <= totalPages; i++) {
                paginationHtml += createPageItem(
                    i,
                    i,
                    i === currentPage ? "active" : ""
                );
            }
        } else {
            if (currentPage > 6) {
                paginationHtml += createPageItem(1, "1");
                if (currentPage > 7) {
                    paginationHtml += createPageItem(0, "...", "disabled");
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHtml += createPageItem(
                    i,
                    i,
                    i === currentPage ? "active" : ""
                );
            }

            if (currentPage + 5 < totalPages) {
                if (currentPage + 6 < totalPages) {
                    paginationHtml += createPageItem(0, "...", "disabled");
                }
                paginationHtml += createPageItem(totalPages, totalPages);
            }
        }

        paginationHtml += createPageItem(
            currentPage + 1,
            "&raquo;",
            "",
            currentPage === totalPages || totalPages === 0
        );
        pagination.html(paginationHtml);
    }

    $("#clearFilters").on("click", () => {
        searchNameInput.val("");
        searchTypeInput.val("");
        searchManaCostInput.val("");
        searchColorInput.val("");
        searchKeywordInput.val("");

        // Remove inline style to revert to CSS default background
        $("body").css("background-color", "");
        currentPage = 1;
        displayCards(allCards);
    });

    pagination.on("click", "a", function (e) {
        e.preventDefault();
        const pageNumber = parseInt($(this).data("page"));
        if (pageNumber && pageNumber > 0) {
            // Verifica se o número da página é válido
            currentPage = pageNumber;
            displayCards(allCards);
            // Scroll to top of card container smoothly
            scrollToCardContainer();
        }
    });

    // Function to scroll smoothly to the card container
    function scrollToCardContainer() {
        $("html, body").animate(
            {
                scrollTop: $("#cardContainer").offset().top - 80, // Adjust offset as needed (e.g., for fixed header)
            },
            800
        ); // Duration of the scroll animation in milliseconds - Increased from 500 to 800
    }

    // --- Search Input Event Handlers ---

    // Use a common class 'search-input' for text inputs that should trigger scroll on Enter
    $(".search-input").on("keypress", function (e) {
        // Check if the key pressed is Enter (key code 13)
        if (e.which === 13) {
            e.preventDefault(); // Prevent default form submission if inside a form
            currentPage = 1;
            displayCards(allCards);
            scrollToCardContainer(); // Scroll down after filtering
        }
    });

    // Handle keyup for live filtering (optional, can be intensive)
    searchNameInput.on("keyup", function (e) {
        if (e.which !== 13) {
            // Avoid double-triggering on Enter
            currentPage = 1;
            displayCards(allCards);
        }
    });

    searchManaCostInput.on("keyup", function (e) {
        if (e.which !== 13) {
            // Avoid double-triggering on Enter
            currentPage = 1;
            displayCards(allCards);
        }
    });

    // Handle change events for select dropdowns
    searchTypeInput.on("change", () => {
        currentPage = 1;
        displayCards(allCards);
        scrollToCardContainer(); // Scroll down after selection change
    });

    searchColorInput.on("change", function () {
        currentPage = 1;
        const selectedColor = $(this).val();
        // Set background based on selection, or remove style if no color selected
        if (selectedColor && manaBgColors[selectedColor]) {
            $("body").css("background-color", manaBgColors[selectedColor]);
        } else {
            $("body").css("background-color", ""); // Revert to CSS default
        }
        displayCards(allCards);
        scrollToCardContainer(); // Scroll down after selection change
    });

    searchKeywordInput.on("change", () => {
        currentPage = 1;
        displayCards(allCards);
        scrollToCardContainer(); // Scroll down after selection change
    });

    function openCardPopup(card) {
        const imageUrl = card.identifiers?.scryfallId
            ? `https://api.scryfall.com/cards/${card.identifiers.scryfallId}/?format=image`
            : defaultImageUrl;

        const purchaseUrls = card.purchaseUrls || {};
        const increasedImageWidth = "80%";
        const increasedImageHeight = "64vh";

        Swal.fire({
            width: "90%",
            height: "93%",
            padding: "1em",
            showConfirmButton: false,
            showCloseButton: true,
            html: `
            <div style="position: relative; display: flex; justify-content: center; align-items: center; margin-bottom: 15px;">
                <img src="${imageUrl}" class="custom-image" alt="${
                card.name
            }" style="max-width: ${increasedImageWidth}; max-height: ${increasedImageHeight};">

            </div>
            <div class="card-details">
                <h2>${card.name}</h2>
                <p>
                    ${Object.entries(card.legalities || {})
                        .map(([format, status]) => {
                            // Added check for legalities existence
                            return `<span style="margin-right: 10px;"><strong>${
                                format.charAt(0).toUpperCase() + format.slice(1)
                            }:</strong> ${status}</span>`;
                        })
                        .join("")}
                </p>
                <div class="purchase-options-below">
                  <button class="purchase-icon-button btn btn-info btn-sm" id="purchaseIconBelow"> <!-- Added bootstrap classes for style -->
                    <img src="https://cdn3.iconfinder.com/data/icons/e-commerce-2-1/72/647-shop-store-basket-market-buy-ecommerce-512.png" alt="Opções de compra" class="purchase-icon" style="width: 20px; height: 20px; vertical-align: middle;">
                     Comprar
                  </button>
                  <div class="purchase-links-below mt-2" style="display: none;"> <!-- Added margin-top -->
                      ${Object.entries(purchaseUrls)
                          .map(([name, url]) => {
                              if (url) {
                                  const displayName = name
                                      .replace(/([A-Z])/g, " $1")
                                      .replace("card", "Card")
                                      .trim();
                                  // Added btn classes for styling links
                                  return `<a href="${url}" target="_blank" class="btn btn-outline-light btn-sm d-block mb-1">${displayName}</a>`;
                              }
                              return "";
                          })
                          .join("")}
                  </div>
                </div>
            </div>
        `,
            customClass: {
                popup: "custom-popup swal2-popup", // Ensure custom popup style applies with dark theme adjustments
                image: "custom-image",
                htmlContainer: "swal2-html-container", // Target container for better control if needed
                closeButton: "swal2-close", // Target close button
            },
            didOpen: () => {
                // Event listener for purchase icon
                $("#purchaseIconBelow").on("click", function () {
                    $(".purchase-links-below").slideToggle();
                });

                // Handle potential image loading error within popup
                $(".custom-image").on("error", function () {
                    $(this).off("error").attr("src", defaultImageUrl); // Fallback image
                    $(this)
                        .parent()
                        .text(`Image for ${card.name} not available.`); // Show text instead
                    $(this).parent().css({
                        color: "var(--popup-text-color)",
                        height: "60vh", // Ensure space is reserved
                        display: "flex",
                        "align-items": "center",
                        "justify-content": "center",
                    });
                });
            },
        });
    }
});
