function filtrages() {
    let input, selectGenre, selectAnnee, selectArtiste, filterText, filterOptionGenre, filterOptionAnnee, filterOptionArtiste, albums, h4, h5, txtValue, h3, txtValueAnnee, txtValueArtiste;
    input = document.getElementById('recherche');
    selectGenre = document.getElementById('genreSelect');
    selectAnnee = document.getElementById('anneeSelect');
    selectArtiste = document.getElementById('artisteSelect');

    filterText = input.value.toUpperCase();
    filterOptionGenre = selectGenre.value.toLowerCase();
    filterOptionAnnee = selectAnnee.value;
    filterOptionArtiste = selectArtiste.value;

    albums = document.querySelectorAll('body > div');

    for (let i = 0; i < albums.length; i++) {
        h4 = albums[i].getElementsByTagName('h4')[0];
        h5 = albums[i].getElementsByTagName('h5')[0]; 
        h3 = albums[i].getElementsByTagName('h3')[0]; 
        if (h4) {
            txtValue = h4.innerText || h4.textContent;
            txtValue = txtValue.replace("Genre: ", "").toLowerCase();
        }
        if (h5) {
            txtValueArtiste = h5.innerText || h5.textContent; 
        }
        if (h3) {
            txtValueAnnee = h3.innerText || h3.textContent; 
        }

        if ((filterText === "" || albums[i].className.toUpperCase().startsWith(filterText)) &&
            (filterOptionGenre === "" || (h4 && txtValue.includes(filterOptionGenre))) &&
            (filterOptionAnnee === "" ||  (h3 && Number(txtValueAnnee) === Number(filterOptionAnnee))) &&
            (filterOptionArtiste === "" || (h5 && txtValueArtiste.trim() === filterOptionArtiste.trim()))) {
            albums[i].style.display = "";
        } else {
            albums[i].style.display = "none";
        }
    }
}