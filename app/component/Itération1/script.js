let templateFile = await fetch("./component/Itération1/template.html");
let template = await templateFile.text();

let Itération1 = {};

Itération1.format = function (movie) {
  let html = template;
  html = html.replace("{{Cover}}", movie.cover);
  html = html.replace("{{Titre}}", movie.titre);
  return html;
};

export { Itération1 };
