const efetuarLogin = ($nome: string, $email: string) => {
    window.localStorage.setItem("nome", $nome);
    window.localStorage.setItem("email", $email);
}