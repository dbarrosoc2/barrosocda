// ** Elements
const pruebaSelect = document.querySelector("#prueba_id");
const placeholderLoading = document.querySelector(".placeholderLoading");
const listPruebasReportar =  document.querySelector('.listPruebasReportar');

document.addEventListener("DOMContentLoaded", () => {
    if (typeof selectedPrueba !== "undefined" && selectedPrueba) {
        pruebaSelect.value= selectedPrueba;

        const btnFormSubmit = document.querySelector(".btnFormSubmit")

        if(typeof pacientesFlag === "undefined"){
            btnFormSubmit.classList.add("btn-outline-secondary");
            btnFormSubmit.classList.remove("btn-primary");
        }
    }

    placeholderLoading.classList.add("d-none");
    document.querySelector("form").classList.remove("d-none");

    if(listPruebasReportar){
        listPruebasReportar.scrollIntoView({behavior: 'smooth'});
    }
});

document.querySelector(".btnFormRestart")?.addEventListener("click", () => {
    pruebaSelect.value= null;
    const btnFormSubmit = document.querySelector(".btnFormSubmit")
    btnFormSubmit.classList.remove("btn-outline-secondary");
    btnFormSubmit.classList.add("btn-primary");
    listPruebasReportar.remove();
});