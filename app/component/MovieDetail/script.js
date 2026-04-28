let templateFile = await fetch("./component/MovieDetail/template.html");
let templateText = await templateFile.text();

let MovieDetail = {};

MovieDetail.format = function(movie){
    let html = templateText;
    html = html.replace("{{image}}", movie.image);
    html = html.replaceAll("{{name}}", movie.name);
    html = html.replace("{{description}}", movie.description);
    html = html.replace("{{director}}", movie.director);
    html = html.replace("{{year}}", movie.year);
    html = html.replace("{{min_age}}", movie.min_age);
    html = html.replace("{{length}}", movie.length);
    html = html.replace("{{trailer}}", movie.trailer);

    return html;
}

export {MovieDetail};