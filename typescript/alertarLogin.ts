const avisoDados: HTMLSpanElement | null = document.querySelector("span#aviso-dados");
const inputEmailLogin: HTMLInputElement | null = document.querySelector("input[name='email']");
const inputSenhaLogin: HTMLInputElement | null = document.querySelector("input[name='senha']");

if (avisoDados && inputEmailLogin && inputSenhaLogin) {
    alertarInput(inputEmailLogin, avisoDados);
    alertarInput(inputSenhaLogin, avisoDados);
}
