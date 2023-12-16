document.addEventListener('DOMContentLoaded', function () {
    
    const params = new URLSearchParams(window.location.search);
    const signupStatus = params.get('signup');
    const loginStatus = params.get('login');

    if (signupStatus === 'success') 
    {
        alert('Sign up successful!');

    } else if (loginStatus === 'success') 
    { 
        alert('Login successful!');
    }

    // slider
    
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slidingImage');
    let currentIndex = 0;

    function updateSlider() {
        const newPosition = -currentIndex * 100 + '%';
        slider.style.transform = 'translateX(' + newPosition + ')';
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    }

    setInterval(nextSlide, 3000); 
});
