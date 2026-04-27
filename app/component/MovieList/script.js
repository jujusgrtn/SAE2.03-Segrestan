let templateFile = await fetch("./component/MovieList/template.html");
let template = await templateFile.text();

let MovieList = {};

MovieList.format = function (movie, onclick = "void(0)") {
  let html = template;
  html = html.replace("{{cover}}", movie.image);
  html = html.replaceAll("{{name}}", movie.name);
  html = html.replace("{{onclick}}", onclick);
  return html;
};

export { MovieList };
