document.addEventListener("DOMContentLoaded", function () {
    M.Toast.dismissAll();

    /**
     * Afficher un message lorsqu'une bouteille a été modifiée
     */
    window.addEventListener("storage", () => {
        if (localStorage.getItem("modifieBouteille")) {
            var toastHTML =
                '<span>Une bouteille a été modifiée</span><button class="btn-flat toast-action">Fermer</button>';
            M.toast({ html: toastHTML, displayLength: 5000 });

            const message = document.querySelector(".toast-action");

            message.addEventListener("click", () => {
                M.Toast.dismissAll();
            });
        }

          /**
            * Afficher un message lorsqu'une bouteille a été supprimée
            */
        if (localStorage.getItem("deleteBouteille")) {
            var toastHTML =
                '<span>Une bouteille a été supprimé</span><button class="btn-flat toast-action">Fermer</button>';
            M.toast({ html: toastHTML, displayLength: 5000 });

            const message = document.querySelector(".toast-action");

            message.addEventListener("click", () => {
                M.Toast.dismissAll();
            });
        }
        localStorage.clear();

        rechercherBouteilles();
    });

    const recherche = document.querySelector("#search");

    /**
     * fonctionnalité pour rechercher des bouteilles
     */
    const rechercherBouteilles = () => {
        fetch(
            `/rechercherCatalogue/${recherche.value
                .trim()
                .replaceAll(".", "~point~")
                .replaceAll("#", "~sharp~")
                .replaceAll("%", "~pourcent~")}`
        )
            .then((response) => {
                return response.json();
            })
            .then((response) => {
                document.querySelector("#table").innerHTML = response.table;
                paginationApresRecherche();
                modifierBouteille();
            })
            .catch((error) => console.log(error));
    };

    recherche.addEventListener("input", () => {
        rechercherBouteilles();
    });

     /**
      *Après une recherche, afficher les bouteilles correspondant au mot clé  et faire fonctionner les liens de la paginations et celle des rangées dans le tableau de bouteilles
      */
    const paginationApresRecherche = () => {
        const pagination = document.querySelector(".pagination");
        if (pagination) {
            pagination.querySelectorAll("a").forEach((lien) => {
                lien.addEventListener("click", (e) => {
                    e.preventDefault();
                    fetch(lien.href)
                        .then((response) => {
                            return response.json();
                        })
                        .then((response) => {
                            document.querySelector("#table").innerHTML =
                                response.table;
                            paginationApresRecherche();
                            modifierBouteille();
                            window.scrollTo(0, 0);
                        });
                });
            });
        }
    };

    /**
     * Au clique de la pagination, afficher les bouteilles correspondant à la page et faire fonctionner les liens de la paginations et celle des rangées dans le tableau de bouteilles
     */
    const paginationDepart = () => {
        const pagination = document.querySelector(".pagination");
        pagination.querySelectorAll("a").forEach((lien) => {
            lien.addEventListener("click", (e) => {
                e.preventDefault();

                fetch(lien.href)
                    .then((response) => {
                        return response.text();
                    })
                    .then((response) => {
                        let html = document.createElement("html");
                        html.innerHTML = response;
                        document.querySelector("#table").innerHTML =
                            html.querySelector("#table").innerHTML;
                        paginationDepart();
                        modifierBouteille();
                        window.scrollTo(0, 0);
                    });
            });
        });
    };

    paginationDepart();

    const supprimerRecherche = document.querySelector("#close");

    /**
     * Supprimer la recherche en cliquant sur le x de la barre de recherche
     */
    supprimerRecherche.addEventListener("click", () => {
        recherche.value = "";
        rechercherBouteilles();
    });

    /**
     * Accéder au formulaire de modification de bouteilles
     */
    const modifierBouteille = () => {
        const tr = document.querySelectorAll("tbody > tr");

        tr.forEach((row) => {
            row.addEventListener("click", () => {
                window
                    .open(
                        location.origin + "/vin/" + row.dataset.id + "/edit",
                        "_blank"
                    )
                    .focus();
            });
        });
    };

    modifierBouteille();
});
