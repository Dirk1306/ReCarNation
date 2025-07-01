const impressumDaten = {
    firmenname: "ReCarNation GmbH",
    anschrift: "Musterstraße 12, 1120 Wien, Österreich",
    vertreter: "Geschäftsführer: Nikola Cvetkovic, Haakon Hu",
    kontakt: {
        telefon: "+49 (0) 123 456789",
        email: "info@RecarNation.com",
        web: "www.RecarNation.com"
    },
    handelsregister: "Handelsregister: HRB 123456, Amtsgericht Wien",
    umsatzsteuer: "Umsatzsteuer-ID: AU123456789",
    haftung: "Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte externer Links."
};


const container = document.getElementById("impressum-container");

container.innerHTML = `
    <p><strong>Firmenname:</strong> ${impressumDaten.firmenname}</p>
    <p><strong>Adresse:</strong> ${impressumDaten.anschrift}</p>
    <p><strong>Vertretungsberechtigt:</strong> ${impressumDaten.vertreter}</p>
    <p><strong>Kontakt:</strong><br>
        Telefon: ${impressumDaten.kontakt.telefon}<br>
        E-Mail: <a href="mailto:${impressumDaten.kontakt.email}">${impressumDaten.kontakt.email}</a><br>
        Website: <a href="home.php" target="_blank">${impressumDaten.kontakt.web}</a>
    </p>
    <p><strong>${impressumDaten.handelsregister}</strong></p>
    <p><strong>${impressumDaten.umsatzsteuer}</strong></p>
    <p><strong>Haftungshinweis:</strong> ${impressumDaten.haftung}</p>
`;