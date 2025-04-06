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
        showCustomAlert('Thank you for contacting SPRK Radio! We will get back to you soon.');
        $(this).trigger('reset');
    });
});

// Disable right-click on the entire page
document.addEventListener('contextmenu', function (event) {
    event.preventDefault();
    showCustomAlert('Right-click is disabled on this website. 🎵');
});

// Custom alert function
function showCustomAlert(message) {
    const alertBox = document.createElement('div');
    alertBox.className = 'custom-alert';
    alertBox.innerHTML = `
        <div class="custom-alert-content">
            <h3>SPRK Radio says:</h3>
            <p>${message}</p>
            <button id="close-alert">OK</button>
        </div>
    `;
    document.body.appendChild(alertBox);

    // Close the alert when the button is clicked
    document.getElementById('close-alert').addEventListener('click', function () {
        document.body.removeChild(alertBox);
    });
}