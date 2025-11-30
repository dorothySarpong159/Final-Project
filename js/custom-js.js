document.addEventListener("DOMContentLoaded", function () {
  /* js for carousel*/
  const slideTrack = document.querySelector(".carousel-slides");
  const allSlides = document.querySelectorAll(".carousel-slide");

  if (slideTrack && allSlides.length > 0) {
    const totalSlides = allSlides.length;
    let currentPicture = 0;
    let playTimer;

    const dotBox = document.createElement("div");
    dotBox.classList.add("carousel-dots");
    slideTrack.after(dotBox);

    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("span");
      dot.classList.add("carousel-dot");
      dot.dataset.index = i;

      if (i === 0) {
        dot.classList.add("active");
      }

      dotBox.appendChild(dot);
    }

    const allDots = dotBox.querySelectorAll(".carousel-dot");

    function showSlide(index) {
      if (index >= totalSlides) {
        index = 0;
      } else if (index < 0) {
        index = totalSlides - 1;
      }

      const moveX = -index * 100;
      slideTrack.style.transform = "translateX(" + moveX + "%)";

      allDots.forEach(dot => dot.classList.remove("active"));
      allDots[index].classList.add("active");

      currentPicture = index;
    }

    function nextSlide() {
      showSlide(currentPicture + 1);
    }

    allDots.forEach(dot => {
      dot.addEventListener("click", function () {
        const newIndex = parseInt(dot.dataset.index);
        showSlide(newIndex);
        restartAutoPlay();
      });
    });

    function startAutoPlay() {
      playTimer = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
      clearInterval(playTimer);
    }

    function restartAutoPlay() {
      stopAutoPlay();
      startAutoPlay();
    }

    window.addEventListener("resize", function () {
      showSlide(currentPicture);
    });

    startAutoPlay();
    showSlide(0);
  }

  /* js for products*/
  const productGallery = document.querySelector(".product-image-gallery");

  if (productGallery) {
    const productImages = productGallery.querySelectorAll(".product-image");
    const prevButton = productGallery.querySelector(".gallery-nav.prev");
    const nextButton = productGallery.querySelector(".gallery-nav.next");
    let currentImageIndex = 0;

    function showImage(index) {
      productImages.forEach(function (img) {
        img.classList.remove("active");
      });
      productImages[index].classList.add("active");
    }

    if (productImages.length > 0) {
      showImage(currentImageIndex);
    }

    if (prevButton) {
      prevButton.addEventListener("click", function () {
        currentImageIndex--;
        if (currentImageIndex < 0) {
          currentImageIndex = productImages.length - 1;
        }
        showImage(currentImageIndex);
      });
    }

    if (nextButton) {
      nextButton.addEventListener("click", function () {
        currentImageIndex++;
        if (currentImageIndex >= productImages.length) {
          currentImageIndex = 0;
        }
        showImage(currentImageIndex);
      });
    }
  }

  /*js for contact*/
  const contactFormDetails = document.querySelector('.contact-form');
    const successMessage = document.querySelector('.success-message');

    if (contactFormDetails && successMessage) {
        contactFormDetails.addEventListener('submit', function (event) {
            event.preventDefault();
            contactFormDetails.style.display = 'none';
            successMessage.style.display = 'flex';
        });
    }


  /* Js for Add to Cart */
const buyBtn = document.querySelector(".buy-button");
if (buyBtn) {
    buyBtn.addEventListener("click", function () {
        const product = {
            id: buyBtn.dataset.id,
            name: buyBtn.dataset.name,
            price: parseFloat(buyBtn.dataset.price),
            quantity: 1,
            image: buyBtn.dataset.image
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingIndex = cart.findIndex(item => item.id === product.id);

        if (existingIndex > -1) {
            cart[existingIndex].quantity += 1;
        } else {
            cart.push(product);
        }

        localStorage.setItem('cart', JSON.stringify(cart));

        const message = document.createElement("div");
        message.textContent = `"${product.name}" Added to cart! `;
        message.className = "cart-alert-message";
        message.addEventListener("click", function () {
            window.location.href = "cart.php";
        });
        document.body.appendChild(message);

        setTimeout(() => {
            message.remove();
        }, 3000);
    });
}

const cartItemsContainer = document.getElementById("cart-items");
if (cartItemsContainer) {

    const cartSummary = document.getElementById("cart-summary");
    const cartSubtotal = document.getElementById("cart-subtotal");
    const cartTotal = document.getElementById("cart-total");
    const emptyCartMessage = document.getElementById("empty-cart-message");
    const thankYouMessage = document.getElementById("thank-you-message");
    const checkoutButton = document.querySelector(".checkout-button");

    function calculateTotals(cart) {
        const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        cartSubtotal.textContent = `$${subtotal.toFixed(2)}`;
        cartTotal.textContent = `$${subtotal.toFixed(2)}`;
    }

    function renderCart() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        cartItemsContainer.innerHTML = "";

        if (cart.length === 0) {
            emptyCartMessage.classList.remove("hidden");
            cartSummary.classList.add("hidden");
        } else {
            emptyCartMessage.classList.add("hidden");
            cartSummary.classList.remove("hidden");

            cart.forEach(item => {
                const cartItem = document.createElement("div");
                cartItem.className = "cart-item";
                cartItem.dataset.id = item.id;

                cartItem.innerHTML = `
                    <img class="cart-item-image" src="${item.image}" alt="${item.name}">
                    <div class="item-details">
                        <h2 class="cart-item-name">${item.name}</h2>
                        <p>Price: <span class="cart-item-price">$${(item.price * item.quantity).toFixed(2)}</span></p>
                    </div>
                    <div class="item-controls">
                        <input type="number" class="item-quantity" value="${item.quantity}" min="1" max="10">
                        <button class="remove-item-button">Remove</button>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
            });

            calculateTotals(cart);
        }
    }

    function updateCartItem(id, quantity) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const index = cart.findIndex(item => item.id === id);
        if (index !== -1) {
            cart[index].quantity = quantity;
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();
        }
    }

    function removeCartItem(id) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart = cart.filter(item => item.id !== id);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    }

    cartItemsContainer.addEventListener("change", function (e) {
        if (e.target.classList.contains("item-quantity")) {
            const id = e.target.closest(".cart-item").dataset.id;
            const quantity = parseInt(e.target.value);
            if (quantity > 0) updateCartItem(id, quantity);
        }
    });

    cartItemsContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-item-button")) {
            const id = e.target.closest(".cart-item").dataset.id;
            removeCartItem(id);
        }
    });

    checkoutButton.addEventListener("click", function () {
        localStorage.removeItem("cart");
        renderCart();
        cartSummary.classList.add("hidden");
        thankYouMessage.classList.remove("hidden");
        emptyCartMessage.classList.add("hidden");
    });

    renderCart();
}
/*js to confirm deletion */
const deleteLinks = document.querySelectorAll(".delete-link");

  deleteLinks.forEach(link => {
    link.addEventListener("click", function (event) {
      const confirmed = confirm("Are you sure you want to delete this product?");
      if (!confirmed) {
        event.preventDefault();
      }
    });
  });

});