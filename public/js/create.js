const modal = document.getElementById("myModal");
const btn = document.getElementById("openAddModal");
const closeBtn = document.getElementById("closeModal");

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
    document.getElementById("pricePerDayShortTerm").value =
        car.price_per_day_short_term; // Assurez-vous d'avoir des IDs uniques
    document.getElementById("pricePerDayLongTerm").value =
        car.price_per_day_long_term; // Assurez-vous d'avoir des IDs uniques
    document.getElementById("priceCaution").value = car.price_caution;
    document.getElementById("totalKm").value = car.total_km;
    document.getElementById("seats").value = car.seats;

    document.getElementById("transmission").value = car.transmission;
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
    if (
        document
            .getElementById("openEditModal")
            .classList.contains("not-hidden")
    ) {
        closeModal();
    }
};

document
    .getElementById("editForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(this);
        formData.append("_method", "PATCH");

        fetch(this.action, {
            method: "POST",
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
                console.log(data);
                document
                    .getElementById("openEditModal")
                    .classList.add("hidden");
            })
            .catch((error) => {
                console.error("Erreur:", error);
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
    document.getElementById("openEditModal").classList.add("hidden");

    const originalUrl = window.location.pathname;
    window.history.replaceState({ path: originalUrl }, "", originalUrl);
}

function setSelectOption(selectId, value) {
    let selectElement = document.getElementById(selectId);
    let options = selectElement.options;
    for (let i = 0; i < options.length; i++) {
        if (options[i].value == value) {
            selectElement.selectedIndex = i;
            break;
        }
    }
}
