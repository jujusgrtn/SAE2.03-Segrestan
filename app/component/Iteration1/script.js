let templateFile = await fetch("./component/Iteration1/template.html");
let template = await templateFile.text();

let Iteration1 = {};

Iteration1.format = function (movie) {
  let html = template;
  html = html.replace("{{Cover}}", movie.image);
  html = html.replace("{{Titre}}", movie.name);
  html = html.replace("{{Titre}}", movie.name);
  return html;
};

export { Iteration1 };
