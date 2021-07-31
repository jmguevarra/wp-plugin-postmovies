
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




const selectTags = document.querySelectorAll('.movie-filter .input-select');
let selectTagIndex = 0;

for(const elem of selectTags){
    elem.firstElementChild.classList.add('select-placeholder');

    elem.addEventListener('change', function(){
        const genreOptions = this.options;
        let optinsIndex = 0;

        for (const optionElem of genreOptions){
            if(optinsIndex === 0){
                optinsIndex++;
                continue;
            }
            
            optionElem.classList = '';
            optinsIndex++;
        }
    
        this.options[this.selectedIndex].classList.add('selected')
    });
    selectTagIndex++;
}
