// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~segrestan1/SAE2.03-Segrestan";

let DataMovie = {};

DataMovie.getAllMovies = async function(age = 0){
    // fetch permet d'envoyer une requête HTTP à l'URL spécifiée. 
    // L'URL est construite en concaténant HOST_URL à "/server/script.php?direction=" et la valeur de la variable dir. 
    // L'URL finale dépend de la valeur de HOST_URL et de dir.
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies&age=" + age);
    // answer est la réponse du serveur à la requête fetch.
    // On utilise ensuite la méthode json() pour extraire de cette réponse les données au format JSON.
    // Ces données (data) sont automatiquement converties en objet JavaScript.
    let data = await answer.json();
    // Enfin, on retourne ces données.
    window.debugData = data;
    return data;
}

DataMovie.getAllCategories = async function(){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readcategories");
    let data = await answer.json();
    return data;
}

DataMovie.addMovie = async function(formData){
    let config = {
        method: "POST",
        body: formData
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addmovie", config);
    let data = await answer.json();
    return data;            
}

DataMovie.requestMovieDetails = async function(id){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=getmoviedetail&id=" + id);
    let data = await answer.json();
    return data;
}

DataMovie.getMoviesByCategory = async function(id_category){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=getmoviesbycategory&id_category=" + id_category);
    let data = await answer.json();
    return data;
}

DataMovie.addFavorite = async function(id_profile, id_movie){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addfavorite&id_profile=" + id_profile + "&id_movie=" + id_movie);
    let data = await answer.json();
    return data;
}

DataMovie.getFavorites = async function(id_profile){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=getfavorites&id_profile=" + id_profile);
    let data = await answer.json();
    return data;
}

DataMovie.removeFavorite = async function(id_profile, id_movie){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=removefavorite&id_profile=" + id_profile + "&id_movie=" + id_movie);
    let data = await answer.json();
    return data;
}

export {DataMovie};
