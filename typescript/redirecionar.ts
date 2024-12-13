const paginasProibidas: string[] = ["databaseConnector.php"];

let urlAtual: string = window.location.href;

if (urlAtual in paginasProibidas) {
    let partesUrl: string[] = urlAtual.split("/");
    let indexUltimaParte: number = partesUrl.length - 1;

    partesUrl[indexUltimaParte] = "index.html";
    document.location.href = partesUrl.join("/");
}
