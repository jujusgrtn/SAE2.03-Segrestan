// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~segrestan1/SAE2.03-Segrestan";

let DataMovie = {};

DataMovie.addMovie = async function(formData){
    let config = {
        method: "POST",
        body: formData
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addmovie", config);
    let data = await answer.json();
    return data;            
}

export {DataMovie};