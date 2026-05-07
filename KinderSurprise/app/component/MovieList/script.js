

let templateFile = await fetch("./component/MovieList/template.html");
let template = await templateFile.text();
let templateliFile = await fetch("component/MovieList/templatelist.html")
let templateli = await templateliFile.text();

let MovieList = {};

MovieList.format = function (movie, onclick) {
  let html = template;
  html = html.replace("{{cover}}", movie.image);
  html = html.replaceAll("{{name}}", movie.name);
  html = html.replace("{{onclick}}", onclick);
  return html;
};

MovieList.formatMany = function(movies, handler ) {
   let html = templateli;
   let tmp = "";
    for (let movie of movies) {
      tmp += MovieList.format(movie, handler + "(" + movie.id + ")");
    }
  html = html.replace("{{movies}}", tmp)
    return html;
};


export { MovieList };
