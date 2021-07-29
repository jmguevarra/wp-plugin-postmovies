
const filterForm = document.querySelector('form.movie-filter');

filterForm.addEventListener('submit', function(e){
    e.preventDefault();
    
    const formData = new URLSearchParams(new FormData(this)),
    moviesCard = document.querySelector('.movie-cards');

    formData.append('action', 'movies_filtering');
    fetch(wpAjax.ajaxURL, {
        method : 'POST',
        body: formData
    }).then(function(res){
        return res.text();
    }).then(function(data){
        moviesCard.innerHTML = data;
    }); 
});