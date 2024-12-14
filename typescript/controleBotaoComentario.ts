const botaoComentario: HTMLButtonElement | null = document.querySelector("form button#botao-comentario");
const formComentario: HTMLFormElement | null = document.querySelector("form");

if (botaoComentario && formComentario) {
    botaoComentario.disabled = window.localStorage.getItem("nome") == null;

    if (!botaoComentario.disabled) {
        formComentario.action = `index.php?nome=${window.localStorage.getItem("nome")}`;
    }

}
