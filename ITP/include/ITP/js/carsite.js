const container = document.getElementById("auto-container");

let userId;
fetch('get_user.php')
  .then(res => res.json())
  .then(data => {
    userId = data.user_id;
    console.log("User-ID aus Session:", userId);
  });

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
                        <button class="btn btn-outline-danger btn-sm favorite-btn" data-id="${auto.Car_id}">
                            ♥
                        </button>
                    </div>
                </div>
            `;

            const favoriteBtn = card.querySelector('.favorite-btn');
            favoriteBtn.addEventListener('click', function (e) {
                e.preventDefault(); // verhindert Weiterleitung durch <a>
                const carId = this.getAttribute('data-id');
                fetch('/itp2025/ReCarNation-2/ITP/save_favorite.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ car_id: carId, user_id: userId }) 
                })
                .then(response => response.text())
                .then(data => alert(data))
                .catch(err => console.error("Fehler beim Speichern:", err));
            });

            container.appendChild(card);
        });
    })
    .catch(err => {
        console.error("Fehler beim Laden:", err);
        container.innerHTML = "<p class='text-danger'>Fehler beim Laden der Autos.</p>";
    });
