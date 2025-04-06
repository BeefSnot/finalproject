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
        event.preventDefault(); // Prevent the default form submission

        const formData = $(this).serialize(); // Serialize form data

        $.post('contact.php', formData, function (response) {
            if (response === "success") {
                $('#form-response').text('Thank you! Your message has been sent. 🎉');
                $('#form-response').css('color', 'green');
                $('#contact-form').trigger('reset'); // Reset the form
            } else {
                $('#form-response').text('Oops! Something went wrong. Please try again. 😢');
                $('#form-response').css('color', 'red');
            }
        });
    });

    // Fetch a random quote using Quotable API
    const quoteUrl = 'https://api.quotable.io/random';

    $.get(quoteUrl, function (data) {
        $('#quote').html(`"${data.content}" - ${data.author}`);
    }).fail(function () {
        $('#quote').html('Unable to fetch a quote. Please try again later.');
    });

    // Fetch weather data using OpenWeatherMap API
    const apiKey = 'your_openweathermap_api_key'; // Replace with your API key
    const city = 'New York'; // Replace with your desired city
    const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    $.get(weatherUrl, function (data) {
        const weather = data.weather[0].description;
        const temp = data.main.temp;
        $('#weather-info').html(`It's currently ${temp}°C with ${weather} in ${city}.`);
    }).fail(function () {
        $('#weather-info').html('Unable to fetch weather data. Please try again later.');
    });
});

// Disable right-click on the entire page
document.addEventListener('contextmenu', function (event) {
    event.preventDefault();
    showCustomAlert('Right-click is disabled on this website. 🎵');
});

// Custom alert function using Bootstrap modal
function showCustomAlert(message) {
    // Check if the modal already exists
    if (!document.getElementById('customAlertModal')) {
        // Create the modal HTML
        const modalHTML = `
            <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="customAlertModalLabel">SPRK Radio says:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>${message}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        // Append the modal to the body
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    // Show the modal using Bootstrap's JavaScript API
    const customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
    customAlertModal.show();
}