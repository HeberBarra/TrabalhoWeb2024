const avisoNome: HTMLSpanElement | null = document.querySelector("span#aviso-nome");
const inputNome: HTMLInputElement | null = document.querySelector("input[name='nome']");

if (inputNome && avisoNome) {
    alertarInput(inputNome, avisoNome);
}
