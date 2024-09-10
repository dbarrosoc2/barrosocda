// Alta paciente
const confirmatorioButtons = document.querySelectorAll('input[name="confirmatorio"]')
confirmatorioButtons?.forEach((e) => {
    e.addEventListener('change',(e)=>{
        if(e.target.value === "0"){
            document.querySelector(".confirmatorio-fecha").classList.add("d-none");
            document.querySelector(".confirmatorio-hospital").classList.add("col-md-10");
            document.querySelector(".confirmatorio-hospital").classList.remove("col-md-6");
            document.querySelector("#fecha_confirmatorio").removeAttribute("required");
        }else if (e.target.value === "1"){
            document.querySelector(".confirmatorio-fecha").classList.remove("d-none");
            document.querySelector(".confirmatorio-hospital").classList.remove("col-md-10");
            document.querySelector(".confirmatorio-hospital").classList.add("col-md-6");
            document.querySelector("#fecha_confirmatorio").setAttribute("required", "true");
        }
    });
})
