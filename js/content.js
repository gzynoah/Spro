window.onload = function() {
    // Call the PHP function to load content when the page loads
    loadContent();
};

function loadContent() {
    // Make an AJAX request to the PHP file to load content
    fetch('http://localhost/php/content.php')
        .then(response => response.json())
        .then(data => {
            // Handle the response data
            const container = document.getElementById('containerMcuCapteur');

            data.forEach(item => {
                container.innerHTML += `
                    <div class="box">
                        <a href="/contentDetails.html?id=${item.id}">
                            <img src="${item.img_src}" alt="${item.alt_text}">
                            <div id="details">
                                <h3>${item.name}</h3>
                                <h4>${item.type}</h4>
                                <h2>${item.price} DH</h2>
                            </div>
                        </a>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}