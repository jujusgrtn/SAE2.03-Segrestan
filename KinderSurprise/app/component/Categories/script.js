import { MovieList } from "../MovieList/script.js";

let templateFile = await fetch("./component/Categories/template.html");
let template = await templateFile.text();

let Categories = {};

Categories.format = function (categoryname, movies) {
    let html = template;
    let moviesHtml = "";
    for (const movie of movies) {
    moviesHtml += MovieList.format(movie);
    }
    html = html.replaceAll("{{categoryname}}", categoryname);
    html = html.replaceAll("{{movies}}", movies);

    return html;
}

export { Categories };