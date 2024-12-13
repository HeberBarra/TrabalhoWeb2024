const bordaAviso = "red solid 0.1rem";
const alertarInput = (input: HTMLInputElement, aviso: HTMLSpanElement) => {
        aviso.style.display = "";
        input.style.border = bordaAviso;
}
