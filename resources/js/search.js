function inputSearchItem(str) {
    searchbox = document.getElementById("searchbox");
    var clean_text = str.replace("/<strong>/?", "")
    searchbox.value = clean_text;
}

function injectGet(str) {
    var form = document.getElementById('movie-search');
    
    form.action = 'movie.php?title=' + str;
}