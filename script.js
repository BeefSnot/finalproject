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

    // Fetch a random quote from a predefined list
    const quotes = [
        { content: "Life’s too short to skip dessert. 🍰", author: "Anonymous" },
        { content: "You’re paws-itively amazing! 🐾", author: "Anonymous" },
        { content: "Believe in yourself, and you’ll be unstoppable. 💪", author: "Anonymous" },
        { content: "Happiness is a warm puppy. 🐶", author: "Charles M. Schulz" },
        { content: "You’re doing great, sweetie! 🌟", author: "Kris Jenner" },
        { content: "When nothing goes right, go left. ⬅️", author: "Anonymous" },
        { content: "You’re the sprinkles on my cupcake! 🧁", author: "Anonymous" },
        { content: "Keep your face to the sunshine and you cannot see a shadow. 🌞", author: "Helen Keller" },
        { content: "Be yourself; everyone else is already taken. 🌈", author: "Oscar Wilde" },
        { content: "You’re one of a kind! 🌟", author: "Anonymous" },
        { content: "Dream big, sparkle more, shine bright. ✨", author: "Anonymous" },
        { content: "You’re the bee’s knees! 🐝", author: "Anonymous" },
        { content: "Stay wild, moon child. 🌙", author: "Anonymous" },
        { content: "You’re a gem! 💎", author: "Anonymous" },
        { content: "Life is short, eat the cake! 🎂", author: "Anonymous" },
        { content: "You’re a limited edition! 🌟", author: "Anonymous" },
        { content: "Be a voice, not an echo. 📣", author: "Anonymous" },
        { content: "You’re the cherry on top! 🍒", author: "Anonymous" },
        { content: "Shine bright like a diamond. 💎", author: "Rihanna" },
        { content: "You’re the sunshine on a rainy day! ☀️", author: "Anonymous" },
        { content: "Keep calm and carry on. 😌", author: "Anonymous" },
        { content: "You’re a star! 🌟", author: "Anonymous" },
        { content: "Be the reason someone smiles today. 😊", author: "Anonymous" },
        { content: "You’re the apple of my eye! 🍏", author: "Anonymous" },
        { content: "Stay positive, work hard, make it happen. 💪", author: "Anonymous" },
        { content: "You’re the Beyoncé of whatever you do. 👑", author: "Anonymous" },
        { content: "Be a cupcake in a world of muffins. 🧁", author: "Anonymous" },
        { content: "You’re the peanut butter to my jelly! 🥜🍇", author: "Anonymous" },
        { content: "Keep your heels, head, and standards high. 👠", author: "Coco Chanel" },
        { content: "You’re the light in my life! 💡", author: "Anonymous" },
        { content: "Slay the day, because you’re fabulous. 💃", author: "Anonymous" },
        { content: "Be a pineapple: stand tall, wear a crown, and be sweet on the inside. 🍍", author: "Anonymous" },
        { content: "You’re one in a melon! 🍉", author: "Anonymous" },
        { content: "Keep shining, the world needs your light. ✨", author: "Anonymous" },
        { content: "Don’t stop until you’re proud. 🌈", author: "Anonymous" },
        { content: "You’re the cat’s whiskers! 🐱", author: "Anonymous" },
        { content: "If you can’t love yourself, how in the hell are you gonna love somebody else? 🌈", author: "RuPaul" },
        { content: "Darling, don’t forget to fall in love with yourself first. 💖", author: "Carrie Bradshaw" },
        { content: "Pour yourself a drink, put on some lipstick, and pull yourself together. 💄", author: "Elizabeth Taylor" },
        { content: "I’m not bossy, I’m the boss. 💼", author: "Beyoncé" },
        { content: "You were born to stand out, not fit in. 🌟", author: "Lady Gaga" },
        { content: "Be the flamingo in a flock of pigeons. 🦩", author: "Anonymous" },
        { content: "You are powerful, beautiful, brilliant, and brave. 💪", author: "Laverne Cox" },
        { content: "Normal is not something to aspire to, it’s something to get away from. 🌈", author: "Jodie Foster" },
        { content: "Don’t be a drag, just be a queen. 👑", author: "Lady Gaga" },
        { content: "You’re a rainbow in someone’s cloud. 🌈", author: "Maya Angelou" },
        { content: "Elegance is the only beauty that never fades. 💎", author: "Audrey Hepburn" },
        { content: "You’re a diamond, darling. They can’t break you. 💎", author: "Anonymous" }
    ];

    // Select a random quote
    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
    $('#quote').html(`"${randomQuote.content}" - ${randomQuote.author}`);

    // Fetch weather data using OpenWeatherMap API
    const apiKey = '7f17c76e3536c4e2e69e150ce32f69b5'; // Replace with your API key
    const city = 'Tulsa'; // Replace with your desired city
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