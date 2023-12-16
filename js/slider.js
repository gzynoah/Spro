document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('containerSlider');
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slidingImage');

    let currentIndex = 0;

    function updateSlider() {
        const newPosition = currentIndex * 100 + '%';
        slider.style.transform = 'translateX(' + newPosition + ')';
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    }

    setInterval(nextSlide, 1000); 
});