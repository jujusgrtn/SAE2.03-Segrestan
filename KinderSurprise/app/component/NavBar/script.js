let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hAccueil, categories, profile, hProfile, hFavorites, avatar) {
    let html = template;
    html = html.replace("{{hAbout}}", hAbout);
    html = html.replace("{{hAccueil}}", hAccueil);
    html = html.replace("{{hProfile}}", hProfile);
    html = html.replace("{{profileName}}", profile);
    html = html.replace("{{hFavorites}}", hFavorites)
    html = html.replace("{{profileAvatar}}", avatar);

    let categoriesHTML = "";
    for (let category of categories) {
    categoriesHTML += `<li class="navbar__menu-item" onclick="C.toggleBurger(); C.handlerFilterByCategory(${category.id})">${category.name}</li>`;
}
    html = html.replace("{{categories}}", categoriesHTML);
    return html;
};

export { NavBar };
