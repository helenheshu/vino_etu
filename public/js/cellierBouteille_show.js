document.addEventListener('DOMContentLoaded', function() {
    var selectMillesime = document.querySelector('[name="select-millesime"]');
    M.FormSelect.init(selectMillesime);
    const wrapper = document.querySelector('.form-modifier-item > .select-wrapper');
    const ajouterMillesime = document.querySelector('[name="ajouterMillesime"]');
    const btnAjouterMillesime = document.querySelector('[data-js-ajouter]')
    let messageMillesime = document.querySelector('#messageMillesime');
    let validMillesime = true;
    let selectedMillesime = document.querySelector('.millesime-item-selected');
    wrapper.classList.add('hide');

    if(localStorage.getItem('supprime') != null) {
        localStorage.clear();
            var toastHTML =
            '<span>Une bouteille a été supprimée</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({ html: toastHTML, displayLength: 5000 });

        const message = document.querySelector(".toast-action");

        message.addEventListener("click", () => {
            M.Toast.dismissAll();
        });
    }
         /**
     * Message Dialogue si une bouteille a été modifiée
     */

          const modifieBouteille = document.querySelector(".modifieBouteille");

          if (modifieBouteille) {
              var toastHTML =
                  '<span>Une bouteille a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
              M.toast({ html: toastHTML, displayLength: 5000 });
      
              const message = document.querySelector(".toast-action");
      
              message.addEventListener("click", () => {
                  M.Toast.dismissAll();
              });
          }
        
        /**
     * Un select permettant de changer de cellier
     */
         var selectCellier = document.querySelector('[name="select-cellier"]');
         M.FormSelect.init(selectCellier);
     
         selectCellier.addEventListener("change", (e) => {
             location.href = location.origin + "/cellier/" + e.target.value;
         });
     
         var selectBouteille = document.querySelector('[name="select-bouteille"]');
         M.FormSelect.init(selectBouteille);
     
         selectBouteille.addEventListener("change", (e) => {
             location.href = location.origin + `/cellier/${selectCellier.value}/${e.target.value}`;
         });

    const boutonMillesime = document.querySelectorAll('[data-js-bouton]');
    const boutonModifier = document.querySelector('[data-js-modifier]');
    const inputs = document.querySelectorAll('[data-js-input]');
    const infoForm =  document.querySelector('[data-js-form]');
    const infoInfo = document.querySelector('.form');
    const btnAnnuleActive = document.querySelector('[data-js-btnAnnuler]')
    const btnValideActive = document.querySelector('[data-js-btnValider]')
    const btnEffacerActive = document.querySelector('[data-js-btnEffacer]')
    const idCellier = location.pathname.split('/')[2]
    const idBouteille = location.pathname.split('/')[3]
    

    let btnMillesime = document.querySelector('[data-millesime]');

    let elMillesime = document.querySelector('[data-millesime]').dataset.millesime;
    
    sessionStorage.setItem('idCellier', idCellier);
    sessionStorage.setItem('idBouteille', idBouteille);

    const datepicker = document.querySelector('.datepicker');
    
    M.Datepicker.init(datepicker,
        {  autoClose : true,
            format : 'yyyy-mm-dd'
            
         });




         datepicker.addEventListener('click', () => {
             // https://stackoverflow.com/questions/5619202/parsing-a-string-to-a-date-in-javascript
            var parts = datepicker.value.split('-');
            var mydate = new Date(parts[0], parts[1] - 1, parts[2]); 
          
            M.Datepicker.getInstance(datepicker).setDate(mydate);
             document.querySelector('.modal-overlay').addEventListener('click', ()=> {
                M.Datepicker.getInstance(datepicker).close()
             })
         })









    /**
     * Note
     */
     new StarRating(".star-rating", {
        maxStars: 5,
        clearable: true,
        classNames: {
            active: "gl-active",
            base: "gl-star-rating",
            selected: "gl-selected",
        },
        stars: function (el, item, index) {
            el.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
        },
        tooltip: false,
    });

     

    /**
     * Ajouter un note à une bouteille en cliquant sur une étoile
     */
     const notes = document.querySelectorAll(".star-rating");

     notes.forEach((note) => {
         note.addEventListener("change", (e) => {
         
           if(wrapper.classList.contains('hide')) {
                const millesime = document.querySelector('.millesime-item-selected').parentElement.dataset.jsBouton;
                
            
                const note = document.querySelector("[data-rating]").dataset.rating;
    
                fetch(
                    `/ajouterNote/${idCellier}/${idBouteille}/${millesime}/${note}`
                )
                .then((response) => {
                    return response.json();
                })
                .then((response) => {
                  if(response.errors){
                      console.log(response)
                  }
                }).catch((error) => console.log(error));
            }
         });
         
     });


     


/* Boutons millesime */

 for (let i = 0; i < boutonMillesime.length; i++) {
       
        boutonMillesime[i].addEventListener("click", function(e) {
        e.preventDefault();
        wrapper.classList.add('hide');
        ajouterMillesime.removeAttribute('disabled');
        boutonModifier.classList.remove("boutonNonValide");
        btnEffacerActive.classList.remove("boutonNonValide");

        for (let i = 0; i < inputs.length; i++){
            inputs[i].readOnly = true;
            inputs[i].classList.remove("input-active");
            inputs[i].classList.add("input-fiche-cercle");
            }
            datepicker.disabled =  true;
         elMillesime = boutonMillesime[i].dataset.jsBouton;
         infoForm.querySelector('#millesime').classList.remove('hide');
         boutonModifier.classList.remove("non-active");
        //  btnEffacerActive.classList.add("non-active");
         btnAnnuleActive.classList.add("non-active");
         btnValideActive.classList.add("non-active");
         btnAnnuleActive.classList.add("non-active")
         btnAjouterMillesime.classList.add('hide')
         
        btnMillesime = boutonMillesime[i];
        document.querySelectorAll('button').forEach(button => {
            button.classList.remove('millesime-item-selected');
        })

        messageMillesime.innerHTML = "";
        

        boutonMillesime[i].querySelector('button').classList.add('millesime-item-selected');
        /* Fetch cellier_Bouteille */

        fetch(`/obtenirMillesime/${idCellier}/${idBouteille}/${elMillesime}`)
        
        .then(response => {
            return (response.json())
        })
        .then(response => {
           
            
            if(value=response[0].millesime != 0){
                infoForm.querySelector('#millesime').value=response[0].millesime;
            }else {
                infoForm.querySelector('#millesime').value = 'N/A';
            }
             infoForm.querySelector('#quantite').value=response[0].quantite;


             infoForm.querySelectorAll('[data-value]').forEach(etoile => {
               
                if(etoile.dataset.value < response[0].note ){
                    etoile.classList.add('gl-active')
                }else if (etoile.dataset.value == response[0].note) {
                    etoile.classList.add('gl-active', 'gl-selected');
                }else {
                    etoile.classList.remove('gl-active', 'gl-selected')
                }
                
             }

             )
             infoForm.querySelector('#prix').value= parseFloat(response[0].prix).toFixed(2);

             infoForm.querySelector('#commentaire').value=response[0].commentaire;
             infoForm.querySelector('#date_achat').value=response[0].date_achat;
             infoForm.querySelector('#garde_jusqua').value=response[0].garde_jusqua;

        }).catch(error => console.log(error))
       
      });

      if(localStorage.getItem('millesime') != null){
          if(localStorage.getItem('millesime') == boutonMillesime[i].dataset.jsBouton){
              boutonMillesime[i].click();
              localStorage.clear();

              var toastHTML =
              '<span>Une bouteille a été ajoutée</span><button class="btn-flat toast-action">Fermer</button>';
          M.toast({ html: toastHTML, displayLength: 5000 });
  
          const message = document.querySelector(".toast-action");
  
          message.addEventListener("click", () => {
              M.Toast.dismissAll();
          });
          }
      }
    }

    /* Activer les champs inputs et les boutons annuler, valider, effacer */ 
    
    /* Bouton modifier*/ 
    boutonModifier.addEventListener("click", function(e) {
        e.preventDefault();

        // boutonModifier.classList.add("non-active");
        for (let i = 0; i < inputs.length; i++){

                inputs[i].readOnly = false;
                inputs[i].classList.add("input-active");
                if (inputs[i].classList.contains("input-fiche-cercle")){
                    inputs[i].classList.remove("input-fiche-cercle");
                }
        }

        if (btnAnnuleActive.classList.contains("non-active")) {
            btnAnnuleActive.classList.remove("non-active");
             }
        if (btnValideActive.classList.contains("non-active")){
            btnValideActive.classList.remove("non-active");
        }
        if (btnEffacerActive.classList.contains("non-active")){
            btnEffacerActive.classList.remove("non-active");
        }
  
        datepicker.disabled = false;
    });

    /** Action bouton annuler ---> efface les champs modifié et retire les boutons annuler, valider et effacer. Réactive le bouton modifier **/
    
    btnAnnuleActive.addEventListener("click",function(e){
        e.preventDefault();
        infoForm.reset();
        
        estValide();
     
        btnAjouterMillesime.removeAttribute('disabled');        
        boutonModifier.classList.remove("boutonNonValide");
        btnEffacerActive.classList.remove("boutonNonValide");
        btnValideActive.classList.add("non-active");
        btnAnnuleActive.classList.add("non-active");
        wrapper.classList.add('hide');
        ajouterMillesime.removeAttribute('disabled');

        infoForm.querySelector('#millesime').classList.remove('hide');
        btnAjouterMillesime.classList.add('hide');
        for (let i = 0; i < inputs.length; i++){
            inputs[i].readOnly = true;
            inputs[i].classList.remove("input-active");
            inputs[i].classList.add("input-fiche-cercle");
            }
            datepicker.disabled =  true;
            btnMillesime.click();   

            selectedMillesime.classList.add('millesime-item-selected');
            messageMillesime.innerHTML = "";
    });


    /** Bouton valider **/
    const btnValideActiveModal = document.querySelector('[data-js-validerModal]')
    btnValideActiveModal.addEventListener("click",function(e){
            e.preventDefault();
            let annee = millesime.value.trim();
             
            if(commentaire.value.trim()==""){
                commentaire.value=" ";
             }
            
            if(isNaN(millesime.value)){
                annee = 0;
            }   

            fetch(`/modifierCellierBouteille/${idCellier}/${idBouteille}/${annee}/${prix.value.trim().replaceAll('.', "~point~")}/${quantite.value}/${date_achat.value}/${commentaire.value}/${garde_jusqua.value}`)
            .then((response) => {
                return response.json();
            })
            .then((response) => {
               
                if(response.errors){
                    console.log(response);
                }else {
                    commentaire.value = commentaire.value.trim();
                    if(estValide()){

                        for (let i = 0; i < inputs.length; i++){
                            inputs[i].readOnly = true;
                            inputs[i].classList.remove("input-active");
                            inputs[i].classList.add("input-fiche-cercle");
                        }
    
                         boutonModifier.classList.remove("non-active");
                        btnAnnuleActive.classList.add("non-active");
                        btnValideActive.classList.add("non-active");
                       
                        infoForm.querySelector('#quantite').value = parseInt(infoForm.querySelector('#quantite').value, 10);
                        infoForm.querySelector('#prix').value = parseFloat(infoForm.querySelector('#prix').value.replace(/^0+/, '')).toFixed(2);
                        var toastHTML =
                        '<span>Une bouteille a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
                    M.toast({ html: toastHTML, displayLength: 5000 });
            
                    const message = document.querySelector(".toast-action");
            
                    message.addEventListener("click", () => {
                        M.Toast.dismissAll();
                    });
                }
                }
            })
              .catch(error => console.log('Le fetch ne fonctionne toujours pas',error))

        });


        /* Bouton supprimer */

        const btnEffacerActiveModal = document.querySelector('[data-js-suprimerModal]')

         btnEffacerActiveModal.addEventListener("click",function(e){
            e.preventDefault();


            fetch(`/suprimerCellierBouteille/${idCellier}/${idBouteille}/${elMillesime}`)
        
            .then(response => {
                return (response.json())
            })
            .then(response => {
                if(boutonMillesime.length > 1) {
                    localStorage.setItem("supprime", "supprime");
                }else {
                    localStorage.setItem("aucunMillesime", "aucunMillesime");
                }
                location.href=response;
    
            }).catch(error => console.log(error))


       });

        /** validation **/

        function estValide() {

            let valide = true;
            let prixRegex ="^[0-9]+(\.[0-9]{1,2})?$";
            let quantiteRegex = /^[0-9]\d*$/;
            if(!prix.value.match(prixRegex)){
                let messagePrix = "Format invalide";
                document.getElementById("messagePrix").innerHTML = messagePrix;
                prix.classList.add("champNonValide");
                valide = false;
            }else if( prix.value < 0 || prix.value > 100000){
                let messagePrix = "Prix de 0 à 100 000";
                prix.classList.add("champNonValide");
                document.getElementById("messagePrix").innerHTML = messagePrix;
                valide = false;
            }else{
                document.getElementById("messagePrix").innerHTML ="";
                prix.classList.remove("champNonValide");
            }

            if(!quantite.value.match(quantiteRegex)){
                let messageQuantite = "Format invalide";
                document.getElementById("messageQuantite").innerHTML = messageQuantite;
                quantite.classList.add("champNonValide");
                valide = false;
            }else if( quantite.value < 0 || quantite.value > 999) {
                let messageQuantite = "Quantité entre 0 et 999";
                quantite.classList.add("champNonValide");
                document.getElementById("messageQuantite").innerHTML = messageQuantite;
                valide = false;
            }else{
                document.getElementById("messageQuantite").innerHTML ="";
                quantite.classList.remove("champNonValide");
            }

            if( commentaire.value.length > 50) {
                let messageCommentaire = "Maximun 50 charactères";
                commentaire.classList.add("champNonValide");
                document.getElementById("messageCommentaire").innerHTML = messageCommentaire;
                valide = false;
            }else{
                document.getElementById("messageCommentaire").innerHTML ="";
                commentaire.classList.remove("champNonValide");
            }

            if( garde_jusqua.value.length > 50) {
                let messageGardeJusqua = "Maximun 50 charactères";
                garde_jusqua.classList.add("champNonValide");
                // btnValideActive.setAttribute("disabled","true");
                document.getElementById("messageGardeJusqua").innerHTML = messageGardeJusqua;
                valide = false;
            }else{
                document.getElementById("messageGardeJusqua").innerHTML ="";
                garde_jusqua.classList.remove("champNonValide");
                // btnValideActive.removeAttribute('disabled');
            }

            return valide;

        }


         inputs.forEach((input) => {
             input.addEventListener("input", (e) => {
                 e.preventDefault();

                 estValide(input);
                  if(!estValide(input)){
                      btnAjouterMillesime
                      btnValideActive.classList.add("boutonNonValide");
                      btnValideActive.setAttribute("disabled","true");
                      btnAjouterMillesime.classList.add("boutonNonValide");
                      btnAjouterMillesime.setAttribute("disabled","true");
                  }else{
                    btnValideActive.classList.remove("boutonNonValide");
                    btnValideActive.removeAttribute('disabled');
                    if(validMillesime) {
                        btnAjouterMillesime.classList.remove("boutonNonValide");
                        btnAjouterMillesime.removeAttribute('disabled');
                    }
                  }
             });
         });

        
      
        
        ajouterMillesime.addEventListener('click', () => {
            ajouterMillesime.setAttribute("disabled","true");
            selectedMillesime = document.querySelector('.millesime-item-selected');
            selectedMillesime.classList.remove('millesime-item-selected');
            boutonMillesime.forEach(bouton => {
                if(bouton.dataset.jsBouton == '0'){
                    messageMillesime.innerHTML = "Millésime existant";
                    wrapper.querySelector('.select-dropdown').classList.add('champNonValide');
                    validMillesime = false;
                    btnAjouterMillesime.classList.add("boutonNonValide");
                    btnAjouterMillesime.setAttribute("disabled","true");
                }
            })

            infoForm.querySelectorAll('[data-value]').forEach(etoile => {
                etoile.classList.remove('gl-active', 'gl-selected');
            })
            document.querySelector("[data-rating]").dataset.rating = 0; 

            boutonModifier.classList.add("boutonNonValide");
            
            for (let i = 0; i < inputs.length; i++){
                    inputs[i].readOnly = false;
                    inputs[i].classList.add("input-active");
                    if (inputs[i].classList.contains("input-fiche-cercle")){
                        inputs[i].classList.remove("input-fiche-cercle");
                    }
            }
            infoForm.querySelector('#millesime').classList.add('hide');
            infoForm.querySelector('#prix').value=parseFloat(0).toFixed(2);
            infoForm.querySelector('#quantite').value=1;
             infoForm.querySelector('#commentaire').value= '';
             infoForm.querySelector('#date_achat').value= new Date().toISOString().slice(0, 10);
             
             infoForm.querySelector('#garde_jusqua').value= '';
      
            datepicker.disabled = false;
            wrapper.classList.remove('hide');
            btnAjouterMillesime.classList.remove('hide');
            btnValideActive.classList.add("non-active");
            btnEffacerActive.classList.add("boutonNonValide");
            btnAnnuleActive.classList.remove("non-active");
           
        })

        btnAjouterMillesime.addEventListener('click', e => {
            e.preventDefault();
             
            if(commentaire.value.trim()==""){
                commentaire.value=" ";
             }        

            const note = document.querySelector("[data-rating]").dataset.rating;
            
             fetch(`/ajouterCellierBouteille/${idCellier}/${idBouteille}/${selectMillesime.value}/${note}/${prix.value.trim().replaceAll('.', "~point~")}/${quantite.value}/${date_achat.value}/${commentaire.value}/${garde_jusqua.value}`)
            .then((response) => {
                return response.json();
            })
            .then((response) => {
         
                if(response.errors){
                    console.log(response);
                }else {
                    commentaire.value = commentaire.value.trim();
                    localStorage.setItem("millesime", selectMillesime.value);
                    location.reload();
                }
                
            })
              .catch(error => console.log('Le fetch ne fonctionne toujours pas',error)) 

      
        })

        selectMillesime.addEventListener('change', () => {
            messageMillesime.innerHTML = "";
            validMillesime = true;
            wrapper.querySelector('.select-dropdown').classList.remove('champNonValide');
            btnAjouterMillesime.classList.remove("boutonNonValide");
            btnAjouterMillesime.removeAttribute('disabled');
            boutonMillesime.forEach(bouton => {
              
                if(bouton.dataset.jsBouton == selectMillesime.value){
                    messageMillesime.innerHTML = "Millésime existant."
                    validMillesime = false;
                    wrapper.querySelector('.select-dropdown').classList.add('champNonValide');
                    btnAjouterMillesime.classList.add("boutonNonValide");
                    btnAjouterMillesime.setAttribute("disabled","true");
                }
            })
        })
});