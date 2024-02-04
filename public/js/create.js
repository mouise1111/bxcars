const modal = document.getElementById("myModal"); // Correction ici
const btn = document.getElementById("openAddModal");
const closeBtn = document.getElementById("closeModal"); // Assurez-vous que l'ID correspond

// Fonction pour ouvrir le modal
btn.addEventListener("click", () => {
    modal.style.display = "block";
});

closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

function openEditModal(car) {
    document.getElementById("carId").value = car.id;
    document.getElementById("modelName").value = car.model_name;
    document.getElementById("pricePerDay").value = car.price_per_day;
    document.getElementById("priceCaution").value = car.price_caution;
    document.getElementById("totalKm").value = car.total_km;
    document.getElementById("seats").value = car.seats;
    setSelectOption("transmission", car.transmission);
    setSelectOption("fuelType", car.fuel_type);
    document.getElementById("disponible").value = car.disponible ? "1" : "0";

    const photoContainer = document.getElementById("currentPhotoContainer");
    if (car.photo) {
        photoContainer.innerHTML = `<img src="${car.photo}" alt="Photo actuelle du véhicule" style="max-width: 100%; height: auto;">`;
    } else {
        photoContainer.innerHTML = "";
    }

    document.getElementById("editForm").action = `/cars/${car.id}`;
    const modal = document.getElementById("openEditModal");
    modal.classList.remove("hidden");
}

window.onpopstate = function (event) {
    // Vous pouvez vérifier ici si le modal est ouvert et le fermer
    if (
        document
            .getElementById("openEditModal")
            .classList.contains("not-hidden")
    ) {
        closeModal(); // Assurez-vous d'avoir une fonction pour fermer le modal
    }
};

document
    .getElementById("editForm")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche la soumission normale du formulaire

        var formData = new FormData(this); // Crée les données du formulaire
        formData.append("_method", "PATCH"); // Ajoute une override pour la méthode PATCH

        fetch(this.action, {
            method: "POST", // Utilise POST ici, mais Laravel interprétera cela comme PATCH grâce à _method
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Réponse réseau non ok");
                }
                return response.json();
            })
            .then((data) => {
                console.log(data); // Traitez la réponse
                document
                    .getElementById("openEditModal")
                    .classList.add("hidden");
                // Actualisez les données affichées sur la page si nécessaire
            })
            .catch((error) => {
                console.error("Erreur:", error);
                // Ici, gérez l'erreur, éventuellement en informant l'utilisateur
            });
        window.location.reload();
    });

document
    .getElementById("closeEditModal")
    .addEventListener("click", function () {
        const modal = document.getElementById("openEditModal");
        modal.classList.add("hidden");
    });

function closeModal() {
    // Fermer le modal
    document.getElementById("openEditModal").classList.add("hidden");

    // Rétablir l'URL
    const originalUrl = window.location.pathname;
    window.history.replaceState({ path: originalUrl }, "", originalUrl);
}

function setSelectOption(selectId, value) {
    let selectElement = document.getElementById(selectId);
    selectElement.value = value;
}
