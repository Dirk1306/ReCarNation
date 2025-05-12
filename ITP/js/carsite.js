const container = document.getElementById("auto-container");

fetch('get_autos.php')
    .then(res => res.json())
    .then(autos => {
        autos.forEach(auto => {
            const card = document.createElement("div");
            card.className = "col-md-4 mb-4";

            card.innerHTML = `
            <a href="details.php?id=${auto.Car_id}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow-sm">
                    <img src="${auto.image}" class="card-img-top" alt="${auto.Name}">
                    <div class="card-body">
                        <h5 class="card-title">${auto.Brand} ${auto.Model}</h5>
                    </div>
                    <div class="card-footer">
                        <strong>Preis: ${auto.Price.toLocaleString('de-DE')} €</strong>
                    </div>
                </div>
            `;

            container.appendChild(card);
        });
    })
    .catch(err => {
        console.error("Fehler beim Laden:", err);
        container.innerHTML = "<p class='text-danger'>Fehler beim Laden der Autos.</p>";
    });
