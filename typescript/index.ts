let nomeUsuario: string | null = window.localStorage.getItem("nome");
let url: string = window.location.href;

if (nomeUsuario && !(url.includes(nomeUsuario))) {
    let partesNome: string[] = nomeUsuario.split(" ");
    let nomeFormatado = partesNome.join("%20");
    window.location.href = `${url}?nome=${nomeFormatado}`;
}
