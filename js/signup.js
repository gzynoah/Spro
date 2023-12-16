function submitForm(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('signupForm'));

    fetch('./php/signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var errorMessageElement = document.getElementById('error-message');
        if (data.status === 'success') {
            window.location.href = 'index.html?signup=success';
        } else {
            errorMessageElement.innerHTML = '<p class="error">' + data.message + '</p>';
        }
    })
    .catch(error => console.error('Error:', error));
}