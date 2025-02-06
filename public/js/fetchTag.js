var input = document.querySelector('input[name="tags"]');
 console.log('hihiho')
fetch('<?=URl?>/core/api.php')
    .then(response => response.json())
    .then(text => {
     console.log("Réponse brute API :", text);
     return JSON.parse(text);
    })
    .then(tags => {
        if(tags){
            console.log(tags)
        }
        else {
            console.log("vide")
        }
        // new Tagify(input, {
        //   whitelist: tags,
        //   userInput: false ,
        //   delimiters: ', '
        // });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des tags :', error);
    });