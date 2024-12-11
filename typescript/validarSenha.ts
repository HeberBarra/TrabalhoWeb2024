const formCadastro: HTMLFormElement | null = document.querySelector("form");
const botaoEnviar: HTMLButtonElement | null = document.querySelector("form button");
const inputSenha: HTMLInputElement | null = document.querySelector("form input[name='senha']");
const inputConfirmarSenha: HTMLInputElement | null = document.querySelector("form input[name='confirmarsenha']");

const validarSenha = () => {
    if (!inputSenha || !inputConfirmarSenha) {
           return;
    }

    let senha: string = inputSenha.value;
    let confirmacaoSenha: string = inputConfirmarSenha.value;

    if (senha != confirmacaoSenha) {
        window.alert("Senhas não coincidem!");
        return;
    }

    formCadastro?.submit();
}

botaoEnviar?.addEventListener("click", validarSenha);
