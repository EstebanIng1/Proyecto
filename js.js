document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', function () {
        menu.classList.toggle('active');
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector(".carousel");
    const slides = document.querySelectorAll(".slide");
    let currentSlide = 0;
    const intervalTime = 3000; // Intervalo en milisegundos (3 segundos en este caso)
    let slideInterval;

    function showSlide(n) {
        slides[currentSlide].style.display = "none";
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].style.display = "block";
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Inicializa el slider mostrando la primera imagen
    showSlide(currentSlide);

    // Botones de navegación
    document.querySelector("#prevBtn").addEventListener("click", function() {
        prevSlide();
        clearInterval(slideInterval); // Detiene el intervalo cuando se hace clic en el botón
        slideInterval = setInterval(nextSlide, intervalTime); // Inicia el intervalo nuevamente
    });

    document.querySelector("#nextBtn").addEventListener("click", function() {
        nextSlide();
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, intervalTime);
    });

    // Inicia el intervalo automático
    slideInterval = setInterval(nextSlide, intervalTime);
});


