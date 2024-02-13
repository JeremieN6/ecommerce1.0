document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carouselExampleCaptions');
    const prevButton = carousel.querySelector('[data-te-slide="prev"]');
    const nextButton = carousel.querySelector('[data-te-slide="next"]');

    prevButton.addEventListener('click', function() {
        const activeItem = carousel.querySelector('.carousel-item.active');
        const prevItem = activeItem.previousElementSibling || carousel.lastElementChild;
        activeItem.classList.remove('active');
        prevItem.classList.add('active');
    });

    nextButton.addEventListener('click', function() {
        const activeItem = carousel.querySelector('.carousel-item.active');
        const nextItem = activeItem.nextElementSibling || carousel.firstElementChild;
        activeItem.classList.remove('active');
        nextItem.classList.add('active');
    });
});
