var input = document.querySelector('input[name="tags"]');

fetch('http://localhost/MVCyoudemy/core/api.php')
    .then(response => response.text()) // Récupérer la réponse en texte brut
    .then(text => {
        console.log("Réponse brute API :", text); // Voir si elle est vide
        return text ? JSON.parse(text) : []; // Éviter l'erreur JSON si la réponse est vide
    })
    .then(tags => {
        console.log("Tags récupérés :", tags);
        new Tagify(input, {
            whitelist: tags.map(t => t.tag),
            userInput: false,
            delimiters: ', '
        });
    })
    .catch(error => {
        console.error("Erreur lors de la récupération des tags :", error);
    });
