const anchorPerfil: HTMLAnchorElement | null = document.querySelector("a#link-perfil");

const mudarLinkPerfil = () => {
    let nome: string | null = window.localStorage.getItem("nome");
    let email: string | null = window.localStorage.getItem("email");

    if (nome == null || email == null || anchorPerfil == null) return

    anchorPerfil.href = anchorPerfil.href + `?nome=${nome}&email=${email}`;
}

mudarLinkPerfil();
