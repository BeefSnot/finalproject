$(document).ready(function () {
    // Smooth scrolling for navigation links
    $('nav a').on('click', function (event) {
        if (this.hash !== '') {
            event.preventDefault();
            const hash = this.hash;
            $('html, body').animate(
                {
                    scrollTop: $(hash).offset().top,
                },
                800
            );
        }
    });

    // Form submission alert
    $('#contact-form').on('submit', function (event) {
        event.preventDefault();
        alert('Thank you for contacting SPRK Radio! We will get back to you soon.');
        $(this).trigger('reset');
    });
});

// Disable right-click on the entire page
document.addEventListener('contextmenu', function (event) {
    event.preventDefault();
    alert('Right-click is disabled on this website. 🎵');
});