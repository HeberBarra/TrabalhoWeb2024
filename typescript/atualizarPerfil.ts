let nomePerfil: string | null = window.localStorage.getItem("nome");
let emailPerfil: string | null = window.localStorage.getItem("email");

if (nomePerfil && emailPerfil) {
    window.location.href = window.location.href.split("?")[0] + `?nome=${nomePerfil}&email=${emailPerfil}`;
}