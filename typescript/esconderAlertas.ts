botaoEnviar?.addEventListener("click", () => {
    let inputsForm: NodeListOf<HTMLInputElement> = document.querySelectorAll("form input");
    let avisosForm: NodeListOf<HTMLSpanElement> = document.querySelectorAll("span.aviso");

    inputsForm.forEach(input => {
        input.style.border = "";
    })

    avisosForm.forEach(aviso => {
        aviso.style.display = "none";
    })
});