let urlAtual: string = document.location.href;
let partesUrl: string[] = urlAtual.split("/");
let indexUltimaParte: number = partesUrl.length - 1;

partesUrl[indexUltimaParte] = "index.html";
let novaUrl = partesUrl.join("/");

document.location.href = novaUrl;
