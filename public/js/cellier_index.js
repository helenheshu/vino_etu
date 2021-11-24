document.addEventListener('DOMContentLoaded', function() {
    var modals = document.querySelectorAll('.modal');
    M.Modal.init(modals);

    const celliers = document.querySelectorAll('.cellier');

    celliers.forEach(cellier => {

      cellier.addEventListener('click', (e) => {
        
         if(e.target.classList.contains('cellier') || e.target.classList.contains('nom-cellier') || e.target.classList.contains('localisation-cellier')){
            location.href = cellier.dataset.lien;
         }
      
      })
    })

    /**
     * Message Dialogue si un cellier a été supprimé
     */

     const deleteCellier = document.querySelector(".deleteCellier");
     

     if (deleteCellier) {
         
         var toastHTML =
             '<span>Un Cellier a été supprimé</span><button class="btn-flat toast-action">Fermer</button>';
         M.toast({ html: toastHTML, displayLength: 5000 });
 
         const message = document.querySelector(".toast-action");
 
         message.addEventListener("click", () => {
             M.Toast.dismissAll();
         });
     }

   /**
     * Message Dialogue si un cellier a été supprimé
     */

    const modifieCellier = document.querySelector(".modifieCellier");
     

    if (modifieCellier) {
        
        var toastHTML =
            '<span>Un Cellier a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({ html: toastHTML, displayLength: 5000 });

        const message = document.querySelector(".toast-action");

        message.addEventListener("click", () => {
            M.Toast.dismissAll();
        });
    }



    
  
  });