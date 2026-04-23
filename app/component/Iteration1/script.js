let templateFile = await fetch("./component/Iteration1/template.html");
let template = await templateFile.text();

let Iteration1 = {};

Iteration1.format = function (movie) {
  let html = template;
  html = html.replace("{{Cover}}", movie.image);
  html = html.replace("{{Titre}}", movie.name);
  html = html.replace("{{Titre}}", movie.name);
  return html;
  if (movie.length == 0) {
    return "<p class='movie__unavailable'>Aucun film disponible pour le moment.</p>";
  }
};

export { Iteration1 };
