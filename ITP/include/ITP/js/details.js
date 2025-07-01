
function getAutoId() {
    const params = new URLSearchParams(window.location.search);
    return params.get("id");
}

const container = document.getElementById("auto-container");
const autoId = getAutoId(); 
console.log("Auto ID:", autoId); 

if (!autoId) {
    container.innerHTML = "<p class='text-danger'>Keine Auto-ID angegeben.</p>";
} else {
    fetch('get_autos.php')
        .then(res => res.json())
        .then(autos => {
             console.log("Alle Autos:", autos); 
            let auto = autoId; 
            
            
            for (let i = 0; i < autos.length; i++) {
                console.log(`Vergleiche Auto-ID: ${autos[i].Car_id} mit URL-ID: ${auto}`);  
                if (autos[i].Car_id === parseInt(autoId)) {
                    auto = autos[i].Car_id; 
                    break; 
                }
            }
            console.log("Gefundenes Auto:", auto); 

            if (auto) {
                
                let autoIndex = auto - 1;  
                const card = document.createElement("div");
                card.className = "col-md-8 offset-md-2 mb-5";

                card.innerHTML = `
                    <div class="card shadow-lg">
                        <img src="${autos[autoIndex].image}" class="card-img-top" alt="${autos[autoIndex].Name}">
                        <div class="card-body">
                            <h2 class="card-title">${autos[autoIndex].Name} ${autos[autoIndex].Model}</h2>
                            <p><strong>Baujahr:</strong> ${autos[autoIndex].year_of_construction}</p>
                            <p><strong>Preis:</strong> ${Number(autos[autoIndex].Price).toLocaleString('de-DE')} €</p>
                            <p><strong>Details:</strong><br>${autos[autoIndex].Information}</p>
                            <a href="carsite.php" class="btn btn-secondary mt-3">Zurück</a>
                            <a href="mailto:info@deinservice.de?subject=Anfrage%20zum%20Auto" class="btn btn-primary mt-3 ms-2">
                                Kontakt per E-Mail
                            </a>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            } else {
                // Auto nicht gefunden
                container.innerHTML = "<p class='text-danger'>Auto nicht gefunden.</p>";
            }
        })
        .catch(err => {
            console.error("Fehler beim Laden:", err);
            container.innerHTML = "<p class='text-danger'>Fehler beim Laden der Auto-Daten.</p>";
        });
}