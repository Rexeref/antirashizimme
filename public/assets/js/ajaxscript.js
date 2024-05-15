var pathArray = window.location.pathname.split('/');

var endpoint = "http://antirashizimme.infinityfreeapp.com/videos/meta/" + pathArray[2];

document.addEventListener('DOMContentLoaded', function () {
    // Function to make AJAX request
    function getMetadata() {
        var xhr = new XMLHttpRequest();

        xhr.open('GET', "http://antirashizimme.infinityfreeapp.com/videos/meta/arte-contro-il-razzismo", true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Parse JSON response
                var metadata = JSON.parse(xhr.responseText);

                // @Joshua Fai in modo che se i metadata sono vuoti non esca il video

                // Display users on the webpage
                displayMetadata(metadata);
                console.log(metadata);
            } else {
                console.error('Error fetching metadata. Status:', xhr.status);
            }
        };

        xhr.onerror = function () {
            console.error('Network error while fetching metadata.');
        };

        xhr.send();
    }

    // Function to display users on the webpage
    function displayMetadata(metadata) {
        var pElement = document.getElementById('parcontainer');

        // Clear previous content
        pElement.textContent = formatDataFromJSON(metadata);
    }
    
    function formatDataFromJSON(data) {
        var formattedData = "";
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                formattedData += key + ": " + data[key] + "<br>";
            }
        }
        return formattedData;
    }
    
    // Fetch users when the page loads
    getMetadata();
});
