let templateFile = await fetch("./component/ProfileSelector/template.html");
let template = await templateFile.text();

let ProfileSelector = {};

ProfileSelector.format = function(profiles) {
    let html = template;
    let profilesHtml = "";
    for (const profile of profiles) {
        let avatar = profile.avatar ? `../server/images/${profile.avatar}` : "./img/default-avatar.png";
        profilesHtml += `
            <li class="profile__selector-item" onclick="C.handlerSelectProfile(${profile.id})">
                <img class="profile__selector-avatar" src="${avatar}" alt="${profile.name}" />
                <p class="profile__selector-name">${profile.name}</p>
            </li>
        `;
    }
    html = html.replace("{{profiles}}", profilesHtml);
    return html;
};

export { ProfileSelector };