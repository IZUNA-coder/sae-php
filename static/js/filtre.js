function filtrages() {
    let input, selectGenre, selectAnnee, filterText, filterOptionGenre, filterOptionAnnee, albums, h4, txtValue, h3, txtValueAnnee;
    input = document.getElementById('recherche');
    selectGenre = document.getElementById('genreSelect');
    selectAnnee = document.getElementById('anneeSelect');

    filterText = input.value.toUpperCase();
    filterOptionGenre = selectGenre.value.toLowerCase();
    filterOptionAnnee = selectAnnee.value;

    albums = document.querySelectorAll('body > div');

    for (let i = 0; i < albums.length; i++) {
        h4 = albums[i].getElementsByTagName('h4')[0];
        h3 = albums[i].getElementsByTagName('h3')[0]; 
        if (h4) {
            txtValue = h4.innerText || h4.textContent;
            txtValue = txtValue.replace("Genre: ", "").toLowerCase();
        }
        if (h3) {
            txtValueAnnee = h3.innerText || h3.textContent; 
        }

        if ((filterText === "" || albums[i].className.toUpperCase().startsWith(filterText)) &&
            (filterOptionGenre === "" || (h4 && txtValue.includes(filterOptionGenre))) &&
            (filterOptionAnnee === "" || (h3 && txtValueAnnee === filterOptionAnnee))) {
            albums[i].style.display = "";
        } else {
            albums[i].style.display = "none";
        }
    }
}