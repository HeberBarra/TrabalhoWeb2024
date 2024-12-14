let urlAtual: string = window.location.href;
let partesUrl: string[] = urlAtual.split("/");
let indexUltimaParte: number = partesUrl.length - 1;

partesUrl[indexUltimaParte] = "index.php";
document.location.href = partesUrl.join("/");
