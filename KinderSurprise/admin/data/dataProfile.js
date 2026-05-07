let HOST_URL = "https://mmi.unilim.fr/~segrestan1/SAE2.03-Segrestan/KinderSurprise/";

let DataProfile = {};

DataProfile.addProfile = async function(formData){
    let answer = await fetch(HOST_URL + "../server/script.php?todo=addprofile", {
        method: "POST",
        body: formData
    });
    let data = await answer.json();
    return data;            
}

export {DataProfile};