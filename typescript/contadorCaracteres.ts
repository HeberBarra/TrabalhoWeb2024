const inputComentario: HTMLInputElement | null = document.querySelector("input[name='comentario']");
const spanContador: HTMLSpanElement | null = document.querySelector("span#quantidade");

if (spanContador) {
    inputComentario?.addEventListener("input", () => {
        spanContador.innerText = inputComentario.value.length.toString();
    })
}
