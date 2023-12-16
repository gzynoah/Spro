function submitForm(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('loginForm'));

    fetch('./php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var errorMessageElement = document.getElementById('error-message');

        if (data.status === 'success') {
            // Redirect to index.html on successful login
            window.location.href = 'index.html?login=success';
        } else {
            // Display error message on login.html
            errorMessageElement.innerHTML = '<p class="error">' + data.message + '</p>';
        }
    })
    .catch(error => console.error('Error:', error));
}