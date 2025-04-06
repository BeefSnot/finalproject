/* General Styling */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom, #1e90ff, #87cefa, #f0f8ff);
    color: #333;
}

header {
    background-color: #1e90ff;
    padding: 20px;
    text-align: center;
    color: #fff;
}

header h1 {
    margin: 0;
    font-size: 2.5em;
}

nav ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 15px;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

nav ul li a:hover {
    background-color: #4682b4;
}

/* Contact Form Styling */
#contact {
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    max-width: 600px;
    margin: 40px auto;
    text-align: center;
}

#contact h2 {
    font-size: 2em;
    margin-bottom: 10px;
    color: #1e90ff;
}

#contact p {
    font-size: 1.2em;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    display: block;
    font-size: 1em;
    margin-bottom: 5px;
    color: #333;
}

input, textarea {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    border: 2px solid #87cefa;
    border-radius: 10px;
    background: #f0f8ff;
    color: #333;
    outline: none;
    transition: border-color 0.3s;
}

input:focus, textarea:focus {
    border-color: #1e90ff;
}

textarea {
    resize: none;
    height: 100px;
}

.submit-button {
    display: inline-block;
    background: #1e90ff;
    color: #fff;
    font-size: 1.2em;
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.submit-button:hover {
    background: #4682b4;
    transform: scale(1.05);
}