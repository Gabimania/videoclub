$(".password").keyup((e)=>{
    if(($("#password").val() == $("#repassword").val()) && $("#password").val().length > 3){
        $("#bntregister").prop("disabled", false);
    } else {
        $("#bntregister").prop("disabled", true);
    }
});


document.addEventListener("DOMContentLoaded", function() {
    var buttons = document.querySelectorAll(".category-button");
    buttons.forEach(function(button) {
        button.addEventListener("click", function() {
            var categoryId = this.dataset.idcategory;
            showFilmsByCategory(categoryId); 
        });
    });
});

function showFilmsByCategory(categoryId) {
    var filmsContainer = document.getElementById('films-container');
    filmsContainer.innerHTML = '';

    fetch("user.php?category=" + categoryId)
        .then(response => response.json())
        .then(data => {
            data.forEach(film => {
                var filmElement = document.createElement('div');
                filmElement.classList.add('film');

                var imageElement = document.createElement('img');
                imageElement.src = film.img;
                filmElement.appendChild(imageElement);

                var nameElement = document.createElement('p');
                nameElement.textContent = film.name;
                filmElement.appendChild(nameElement);

                var availableElement = document.createElement('p');
                availableElement.textContent = 'Available: ' + (film.available ? 'Yes' : 'No');
                filmElement.appendChild(availableElement);

                filmsContainer.appendChild(filmElement);
            });
        })
        .catch(error => {
            console.error("Error fetching films:", error);
        });
}
