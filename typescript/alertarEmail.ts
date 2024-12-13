const avisoEmail: HTMLSpanElement | null = document.querySelector("span#aviso-email");
const inputEmail: HTMLInputElement | null = document.querySelector("input[name='email']");

if (inputEmail && avisoEmail) {
    alertarInput(inputEmail, avisoEmail)
}
