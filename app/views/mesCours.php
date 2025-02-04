<?php 
require_once '../autoload.php';
session::ActiverSession();
if(!isset($_SESSION['userData']['iduser']) || $_SESSION['userData']['role']!=2){
    header('location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Liste des Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
</head>

<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Dashboard Professeur</h2>
            </div>
            <nav class="mt-4">
                <a href="#dashboard" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Tableau de bord</a>
                <a href="#courses" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Mes cours</a>
                <a href="statistiqueProf.php" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Statistique</a>
                <form action="../traitement/traitementProf.php" method="post">
                    <button name="deconnexion" class="hover:text-gray-600">Déconnexion</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
        
            <div class="bg-white rounded-lg shadow-md p-6">
            <select onchange="afficherChamps()" id="typeCours" name="typeCours"   class="w-full px-3 py-2 m-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
                            <option value="">Choisir type de cours a affichee.</option>
                    <option value="vedio"> avec vedio</option>
                    <option value="document">avec documentation</option>
                        </select>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Liste des Cours</h2>
                    <button id="bteAjoutCours" class="bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                        Nouveau cours
                    </button>
                </div>

                <table id="videoCoursesTable"  class="session w-full">
                    <caption  class="text-2xl font-bold text-gray-800 p-2"> Vedio Cours</caption>
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Titre</th>
                            <th class="px-4 py-3 text-left">Catégorie</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Étudiants</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - Replace with PHP loop -->
                         <?php
                             require_once '../traitement/traitementProf.php';
                           foreach($coursVedio as $cours){
                            ?>
                           
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                <img src="<?=$cours->image?>" alt="Course" class="rounded-lg w-10 h-10 object-cover">
                            </td>
                            
                            <td class="px-4 py-3"><?= $cours->titre?></td>
                            <td class="px-4 py-3"><?= $cours->categorie->getCategorie()?></td>
                            <td class="px-4 py-3">Vidéo</td>
                            <td class="px-4 py-3">32</td>
                            <td class="px-4 py-3">2024-01-15</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded"><?= $cours->status?></span>
                            </td>
                            <td class="px-4 py-3 flex">
                                <button 
                                    data_id="<?=$cours->idcours?>"
                                    data-titre="<?=$cours->titre?>"
                                    data-description="<?=$cours->description?>"
                                    data-image="<?=$cours->image?>"
                                    class="edit text-blue-500 hover:text-blue-700 mr-2">
                                    Éditer
                                </button>
                                <form action="../traitement/traitementProf.php" method="post">
                                    <input type="hidden" name="idcours" value="<?=$cours->idcours?>">
                                    <input type="hidden" name="titre" value="<?=$cours->titre?>">
                                    <input type="hidden" name="description" value="<?=$cours->description?>">
                                    <input type="hidden" name="image" value="<?=$cours->image?>">
                                <button name="delete"class="text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                               
                            </td>
                        </tr>
                        <?php 
                           }
                            ?>
                    </tbody>
                </table>


                <table id="documentCoursesTable" class="session w-full hidden ">
                    <caption  class="text-2xl font-bold text-gray-800 p-2"> cours Document</caption>
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Titre</th>
                            <th class="px-4 py-3 text-left">Catégorie</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Étudiants</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - Replace with PHP loop -->
                        <?php
                             require_once '../traitement/traitementProf.php';
                             foreach($coursDocument as $cours){
                            ?>
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                <img src="<?=$cours->image?>" alt="Course" class="rounded-lg w-10 h-10 object-cover">
                            </td>
                            <td class="px-4 py-3"><?= $cours->titre?></td>
                            <td class="px-4 py-3"><?= $cours->categorie->getCategorie()?></td>
                            <td class="px-4 py-3">Document</td>
                            <td class="px-4 py-3">32</td>
                            <td class="px-4 py-3">2024-01-15</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                            </td>
                            <td class="px-4 py-3 flex">
                                <button
                                data_id="<?=$cours->idcours?>"
                                    data-titre="<?=$cours->titre?>"
                                    data-description="<?=$cours->description?>"
                                    data-image="<?=$cours->image?>"
                                class=" edit text-blue-500 hover:text-blue-700 mr-2">Éditer</button>
                                <form action="../traitement/traitementProf.php" method="post">
                                    <input type="hidden" name="idcours" value="<?=$cours->idcours?>">
                                    <input type="hidden" name="titre" value="<?=$cours->titre?>">
                                    <input type="hidden" name="description" value="<?=$cours->description?>">
                                    <input type="hidden" name="image" value="<?=$cours->image?>">
                                <button name="delete"class="text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                               
                            </td>
                        </tr>
                        <?php 
                           }
                            ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <!-- modael cours -->
     
    <div id='modale' class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <!-- Modal -->
    <div class="bg-white rounded-lg w-full max-w-2xl mx-4">
        <!-- Modal Header -->
        <div class="border-b p-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Ajouter un nouveau cours</h3>
            <button class="text-gray-600 hover:text-gray-800" onclick="closeModal()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form class="space-y-6" action="../traitement/traitementProf.php" method="POST" enctype="multipart/form-data">
                <!-- Titre du cours -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Titre du cours
                    </label>
                    <input 
                        type="text" 
                        name="titre"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent"
                        placeholder="ex: JavaScript pour débutants"
                    >
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea 
                       name="description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent"
                        rows="2"
                        placeholder="Décrivez le contenu de votre cours..."
                    ></textarea>
                </div>

                <!-- Tag et Catégorie -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tag
                        </label>
                        <input type="text" name="tags" class="some_class_name tagify w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Catégorie
                        </label>
                        <select name="categorie" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
                           
                            <?php 
                            $categories = categorie::affichecategorie();
                            if (!empty($categories)) {
                                foreach ($categories as $cat) {
                                    echo "<option value='{$cat['idcategorie']}'>{$cat['categorie']}</option>";
                                }
                            } else {
                                echo "<option disabled>Aucune catégorie disponible</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Image du cours -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Image de couverture
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-[#B6FFA1] hover:text-green-600">
                                    <span>Télécharger un fichier</span>
                                    <input type="file" class="sr-only" name="image">
                                </label>
                                <p class="pl-1">ou glisser-déposer</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                jpg, PNG, SVG jusqu'à 10MB
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                   
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                        Type de cours
                        </label>
                        <select onchange="afficherChampsmodale()" id="typeCoursmodle" name="typeCours"   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
                            <!-- PHP logic for categories -->
                            <option value="">Choisir...</option>
                    <option value="vedio"> avec vedio</option>
                    <option value="document">avec documentation</option>
                        </select>
                    </div>
                    <div id="divUrl" style="display:none;">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">vedio:</label>
                    <input type="file" id="url" name="url" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent" placeholder="ex: https://example.com">
                </div>

                <!-- Champ spécifique pour les cours en présentiel -->
                <div id="divLieu" style="display:none;">
                    <label for="lieu" class="block text-sm font-medium text-gray-700 mb-1">documenation :</label>
                    <input type="file" id="lieu" name="document" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent" placeholder="ex: Paris, Salle 101">
                </div>
                </div>

              

                <!-- Sections du cours -->
                <button name="ajoutCours" class="px-4 py-2 bg-[#B6FFA1] text-gray-700 rounded-md hover:bg-opacity-80">
                    + Ajouter une leçon
                </button>
            </form>
        </div>
    </div>
</div>
<!-- ********************************modal edit cours -->

<div id="EDITModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Nouvelle Catégorie</h3>
                <button onclick="closeModal2('EDITModal')" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-4" action="../traitement/traitementProf.php" method="POST">
                <div>
                    <input type="text" id="modal-id" name="idcours">
                    <label class="block text-sm font-medium text-gray-700 mb-1">TItre</label>
                    <input type="text"  id="modal-titre" name="TItre" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">description</label>
                    <textarea id="modal-description" name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]"></textarea>
                </div>
               
                <button type="submit" name="editCours" class="w-full bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                    Ajouter
                </button>
            </form>
        </div>
    </div>
    <script>
          const editButtons = document.querySelectorAll('.edit');
        const modal = document.querySelector('#EDITModal');
        // const overlay = document.querySelector('.overlay');
        const closeButton = modal.querySelector('.close-btn');

        // Références aux éléments du modal
        const modalId = document.getElementById('modal-id');
        const modalTitre = document.getElementById('modal-titre');
        const modalDescription = document.getElementById('modal-description');
        // const modalImage = document.getElementById('modal-image');

        // Ajouter un écouteur d'événement à chaque bouton
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Récupérer les données dynamiques
                const id = button.getAttribute('data_id');
                const titre = button.getAttribute('data-titre');
                const description = button.getAttribute('data-description');
                // const image = button.getAttribute('data-image');
             console.log(titre);
                // Insérer les données dans le modal
                modalId.value = id;
                modalTitre.value = titre;
                modalDescription.value = description;
                // modalImage.textContent = image;

                // Afficher le modal et l'overlay
                modal.classList.remove('hidden');
                // overlay.classList.add('active');
            });
        });

         let bteAjoutCours=document.getElementById('bteAjoutCours');
       bteAjoutCours.addEventListener('click',()=>{
        document.getElementById('modale').classList.remove('hidden');
       })

       function closeModal() {
        document.getElementById('modale').classList.add('hidden');
        }

        function closeModal2() {
            modal.classList.add('hidden');
        }
        var input = document.querySelector('input[name="tags"]');

fetch('../traitement/fetchtag.php')
.then(response => response.json())
.then(tags => {
  new Tagify(input, {
    whitelist: tags, 
    userInput: false ,
    delimiters: ', '
  });
})
.catch(error => {
  console.error('Erreur lors de la récupération des tags :', error);
});

function afficherChampsmodale() {
            var typeCours = document.getElementById('typeCoursmodle').value;
            var divUrl = document.getElementById('divUrl');
            var divLieu = document.getElementById('divLieu');
            divUrl.style.display = 'none';
            divLieu.style.display = 'none';
            if (typeCours === 'vedio') {
                divUrl.style.display = 'block';
            } else if (typeCours === 'document') {
                divLieu.style.display = 'block';
            }
        }
    function afficherChamps() {
        const typeCours = document.getElementById("typeCours").value;
        const videoTable = document.getElementById("videoCoursesTable");
        const documentTable = document.getElementById("documentCoursesTable");

        if (typeCours === "vedio") {
            videoTable.classList.remove("hidden");
            documentTable.classList.add("hidden");
        } else if (typeCours === "document") {
            documentTable.classList.remove("hidden");
            videoTable.classList.add("hidden");
        } else {
            videoTable.classList.remove("hidden");
            documentTable.classList.add("hidden");
        }
    }    
    </script>
</body>
</html>

<?php
if (isset($_SESSION['success'])) {
    $Message = $_SESSION['success'];
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: '$Message',
                confirmButtonText: 'OK',
                timer: 5000
            });
        </script>
    ";
    unset($_SESSION['success']);
}