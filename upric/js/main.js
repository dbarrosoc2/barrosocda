(function() {
    "use strict";
  
    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
      el = el.trim()
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    }
  
    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
      if (all) {
        select(el, all).forEach(e => e.addEventListener(type, listener))
      } else {
        select(el, all).addEventListener(type, listener)
      }
    }
  
    /**
     * Easy on scroll event listener 
     */
    const onscroll = (el, listener) => {
      el.addEventListener('scroll', listener)
    }
  
    /**
     * Sidebar toggle
     */
    if (select('.toggle-sidebar-btn')) {
      on('click', '.toggle-sidebar-btn', function(e) {
        select('body').classList.toggle('toggle-sidebar')
      })
    }
  
  
    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
      let position = window.scrollY + 200
      navbarlinks.forEach(navbarlink => {
        if (!navbarlink.hash) return
        let section = select(navbarlink.hash)
        if (!section) return
        if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
          navbarlink.classList.add('active')
        } else {
          navbarlink.classList.remove('active')
        }
      })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)
  
    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header')
    if (selectHeader) {
      const headerScrolled = () => {
        if (window.scrollY > 100) {
          selectHeader.classList.add('header-scrolled')
        } else {
          selectHeader.classList.remove('header-scrolled')
        }
      }
      window.addEventListener('load', headerScrolled)
      onscroll(document, headerScrolled)
    }
  
    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
      const toggleBacktotop = () => {
        if (window.scrollY > 100) {
          backtotop.classList.add('active')
        } else {
          backtotop.classList.remove('active')
        }
      }
      window.addEventListener('load', toggleBacktotop)
      onscroll(document, toggleBacktotop)
    }
  
    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  
    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll('.needs-validation')
  
    Array.prototype.slice.call(needsValidation)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
})();

// ** Sidebar
document.querySelector(".sidebar-nav")?.addEventListener("click", (e) => {
  const listItemFlag = e.target.closest('li');
  if (listItemFlag) {
    document.querySelector("body").classList.remove("toggle-sidebar");
  }
});

document.querySelector(".sidebar-background")?.addEventListener("click", (e) => {
  document.querySelector("body").classList.remove("toggle-sidebar");
});

// ** Forms
const btnRestart = document.querySelector('.btnFormRestart');
btnRestart?.addEventListener('click', () => {
  document.querySelector('form').reset();
})

// Eliminar item
let deleteId, deleteName, deleteURL, deleteType;
let modalPregunta;
document.querySelector("table")?.addEventListener("click", (e) => {
    const btnDelete = e.target;
    const deleteCurrentId = e.target.dataset.deleteId;
    
    if (deleteCurrentId && (btnDelete.nodeName === 'BUTTON' || btnDelete.nodeName === 'I')) {
        deleteName = e.target.dataset.deleteName;
        deleteId = deleteCurrentId;
        deleteURL = e.target.dataset.deleteUrl;
        deleteType = e.target.dataset.deleteType;
        document.querySelector(".deleteName").textContent = deleteName;
        document.querySelector(".modalPreguntaContinuar")?.addEventListener("click", handleEliminarBtn)

        const modal = document.querySelector(".modalPregunta");
        modalPregunta = new bootstrap.Modal(modal)
        modalPregunta.show();
    }
})

const handleEliminarBtn = async () => {
    modalPregunta.hide();

    try {
        const data = new URLSearchParams();
        let mensaje;

        if(deleteType === "paciente"){
          data.append('id_paciente', deleteId)
          mensaje = `<i class="bi bi-check-circle me-1"></i>El paciente <strong class="me-2 ms-2">${deleteName}</strong> fue eliminado correctamente.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>` 
        }else if(deleteType === "prueba"){
          data.append('id_prueba', deleteId)
          mensaje = `<i class="bi bi-check-circle me-1"></i>La prueba <strong class="me-2 ms-2">${deleteName}</strong> fue eliminada correctamente.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`
        }else if(deleteType === "usuario"){
          data.append('id_usuario', deleteId)
          mensaje = `<i class="bi bi-check-circle me-1"></i>El usuario <strong class="me-2 ms-2">${deleteName}</strong> fue eliminado correctamente.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`
        }

        const result = await fetch(deleteURL, {
            method: 'POST',
            body: data
        })

        const response = await result.text()
        if (response === "deleted"){
            let alertElement = document.createElement("div");
            alertElement.classList.add("alert", "alert-success", "alert-dismissible", "fade", "show");
            alertElement.setAttribute("role", "alert");
            alertElement.innerHTML = mensaje;

            document.querySelector(`table tbody tr[data-delete-row-id="${deleteId}"]`).remove();
            document.querySelector("table").parentElement.prepend(alertElement);
            document.querySelector(".card").scrollTo({top: 0, behavior: 'smooth'});
        }
    } catch (error) {
        console.log(error)
    }
}

// Show Modal
const modal = document.querySelector(".modal:not(.no-auto-show)");
if(modal){
    const newModal = new bootstrap.Modal(modal)
    newModal.show();
}