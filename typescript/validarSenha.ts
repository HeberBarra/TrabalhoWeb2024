const formCadastro: HTMLFormElement | null = document.querySelector("form");
const botaoEnviar: HTMLButtonElement | null = document.querySelector("form button");
const inputSenha: HTMLInputElement | null = document.querySelector("form input[name='senha']");
const inputConfirmarSenha: HTMLInputElement | null = document.querySelector("form input[name='confirmarsenha']");
const avisoSenha: HTMLSpanElement | null = document.querySelector("span#aviso-senha");

const validarSenha = () => {
    if (!inputSenha || !inputConfirmarSenha || !avisoSenha) {
           return;
    }

    let senha: string = inputSenha.value;
    let confirmacaoSenha: string = inputConfirmarSenha.value;

    if (senha != confirmacaoSenha) {
        let bordaSenhaErrada = "red solid 0.1rem";
        avisoSenha.style.display = "";
        inputSenha.style.border = bordaSenhaErrada;
        inputConfirmarSenha.style.border = bordaSenhaErrada;
        return;
    } else {
        avisoSenha.style.display = "none";
        inputSenha.style.border = "";
        inputConfirmarSenha.style.border = "";
    }

    formCadastro?.submit();
}

botaoEnviar?.addEventListener("click", validarSenha);
