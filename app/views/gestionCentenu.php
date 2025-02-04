<?php

require_once '../autoload.php';
Session::ActiverSession();
if(!isset($_SESSION['userData']['iduser']) || $_SESSION['userData']['role']!=3){
    header('location: connexion.php');
}
$categories = categorie::affichecategorie();
?>
<!DOCTYPE html> 
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Gestion de Contenu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Admin Dashboard</h2>
            </div>
            <nav class="mt-4">
                <a href="statiqueAdmin.php" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Statistiques</a>
                <a href="#content" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Gestion Contenu</a>
                <a href="gestionProfEtudiant.php" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Gestion Utilisateurs</a>
                <form action="../traitement/traitementAdmin.php" method="post">
                    <button name="deconnexion" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Déconnexion</button>
                    </form>
               
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Buttons Section -->
            <div class="mb-6 flex flex-wrap gap-4">
                <button onclick="showTable('coursTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Cours
                </button>
                <button onclick="showTable('categorieTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Catégories
                </button>
                <button onclick="showTable('tagTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Tags
                </button>
            </div>

            <!-- Cours Table -->
            <div id="coursTable" class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-4">Liste des Cours en Attente</h3>
                <div class="overflow-x-auto">
                    <table id="cours" class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Titre</th>
                                <th class="text-left py-3 px-4">Professeur</th>
                                <th class="text-left py-3 px-4">Catégorie</th>
                                <th class="text-left py-3 px-4">status</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $coures = cours::getTousCours();
                            foreach ($coures as $cours) {
                            ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?= $cours->titre ?></td>
                                    <td class="py-3 px-4"><?= $cours->prof->nom ?></td>
                                    <td class="py-3 px-4"><?= $cours->categorie->getcategorie() ?></td>
                                    <td class="py-3 px-4"><?= $cours->status ?></td>
                                    <td class="py-3 px-4">
                                        <div class="flex">
                                            <form action="../traitement/traitementAdmin.php" method="post">
                                                <input type="hidden" name="idcours" value="<?= $cours->idcours ?>">
                                                <input type="hidden" name="titre" value="<?= $cours->titre ?>">
                                                <input type="hidden" name="description" value="<?= $cours->description ?>">
                                                <input type="hidden" name="titre" value="<?= $cours->titre ?>">
                                                <input type="hidden" name="image" value="<?= $cours->image ?>">
                                                <button name="accepterCours" class="bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600">
                                                    Accepter
                                                </button>
                                            </form>
                                            <form action="../traitement/traitementAdmin.php" method="post">
                                                <input type="hidden" name="idcours" value="<?= $cours->idcours ?>">
                                                <input type="hidden" name="titre" value="<?= $cours->titre ?>">
                                                <input type="hidden" name="description" value="<?= $cours->description ?>">
                                                <input type="hidden" name="titre" value="<?= $cours->titre ?>">
                                                <input type="hidden" name="image" value="<?= $cours->image ?>">
                                                <button name="RefuserCours" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                    Refuser
                                                </button>
                                            </form>
                                        </div>


                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Catégories Table -->
            <div id="categorieTable" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Liste des Catégories</h3>
                    <button onclick="showModal('categorieModal')" class="bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                        + Nouvelle Catégorie
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table id="categorie" class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Nom</th>
                                <th class="text-left py-3 px-4">Nombre de cours</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            foreach ($categories as $categorie) {
                            ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?= $categorie['categorie'] ?></td>
                                    <td class="py-3 px-4">35</td>
                                    <td class="py-3 px-4">
                                        <div class=" flex">
                                            
                                            <button 
                                            data-id="<?=$categorie['idcategorie']?>"
                                            data-categorie="<?=$categorie['categorie']?>"
                                            class="edit text-blue-500 hover:text-blue-700 mr-3">Modifier</button>
                                            <form action="../traitement/traitementAdmin.php" method="post">
                                                <input type="hidden" name="idcategorie" value="<?=$categorie['idcategorie']?>">
                                                <input type="hidden" name="categorie" value="<?=$categorie['categorie']?>">
                                                <button  name="supprimerCategorie" class="text-red-500 hover:text-red-700">Supprimer</button>
                                            </form>

                                        </div>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tags Table -->
            <div id="tagTable" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Liste des Tags</h3>
                    <button onclick="showModal('tagModal')" class="bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                        + Nouveau Tag
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table id="tag" class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Nom</th>
                                <th class="text-left py-3 px-4">Utilisation</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tags=tag::afficheTag();
                            foreach($tags as $tag){

                            ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4"><?=$tag->getTag()?></td>
                                <td class="py-3 px-4"><?=$tag->getId()?></td>
                                <td class="py-3 px-4">
                                    <button
                                    data-id="<?=$tag->getId()?>"
                                    data-tag="<?=$tag->getTag()?>"
                                    class="edittag text-blue-500 hover:text-blue-700 mr-3">Modifier</button>
                                    <button class="text-red-500 hover:text-red-700">Supprimer</button>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Catégorie -->
    <div id="categorieModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Nouvelle Catégorie</h3>
                <button onclick="closeModal('categorieModal')" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-4" action="../traitement/traitementAdmin.php" method="POST">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                    <input type="text"  name="categorie" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]">
                </div>
                <button type="submit" name="ajoutCategorie" class="w-full bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                    Ajouter
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Tag -->
    <div  id='tagModal' class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <!-- Modal -->
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4">
            <!-- Modal Header -->
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Ajouter un nouveau tag </h3>
                <button class="text-gray-600 hover:text-gray-800" onclick="closeModal2()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
                <div class="p-6">
                <form class="space-y-6" action="../traitement/traitementAdmin.php" method="POST">
                    <!-- Titre du cours -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            tag
                        </label>
                        <input 
                            type="text"
                            name="tags"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent"
                            placeholder="ex: JavaScript pour débutants"
                            require
                           >
                        </div>
                   
                                <button type="submit" name="ajoutTag" class="px-4 py-2 bg-[#B6FFA1] text-gray-700 rounded-md hover:bg-opacity-80">
                                    + Ajouter tags
                                </button>
                        
                </form>
            </div>
        </div>
    </div>

    <!-- modal edit categorie -->
    <div id="categorieModalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Nouvelle Catégorie</h3>
                <button onclick="closeModal('categorieModalEdit')" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-4" action="../traitement/traitementAdmin.php" method="POST">
                <div>
                    <input type="text" name="idcategorie" id="modal-id">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                    <input type="text" id="modal-categorie" name="categorie" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]">
                </div>
                <button type="submit" name="EditCategorie" class="w-full bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                    Edit
                </button>
            </form>
        </div>
    </div>

    <!-- modal edit tag -->
    <div id="tagModalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Nouvelle Catégorie</h3>
                <button onclick="closeModal('tagModalEdit')" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-4" action="../traitement/traitementAdmin.php" method="POST">
                <div>
                    <input type="text" name="idtag" id="modal-idtag">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                    <input type="text" id="modal-tag" name="tag" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]">
                </div>
                <button 
                type="submit" name="Edittag" class="w-full bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                    Edit
                </button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>

const editButtons = document.querySelectorAll('.edit');
        const modal = document.querySelector('#categorieModalEdit');
        const modalId = document.getElementById('modal-id');
        const modalTitre = document.getElementById('modal-categorie');
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const titre = button.getAttribute('data-categorie');
                modalId.value = id;
                modalTitre.value = titre;
                modal.classList.remove('hidden');
            
            });
        });

        // edit tag

        const editButtonstag = document.querySelectorAll('.edittag');
        const modaltag = document.querySelector('#tagModalEdit');
        const modalIdtag = document.getElementById('modal-idtag');
        const modalTitretag = document.getElementById('modal-tag');
        editButtonstag.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const titre = button.getAttribute('data-tag');
               
                modalIdtag.value = id;
                modalTitretag.value = titre;
                modaltag.classList.remove('hidden');
            
            });
        });
        function showTable(tableId) {
            // Hide all tables
            ['coursTable', 'categorieTable', 'tagTable'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            // Show selected table
            document.getElementById(tableId).classList.remove('hidden');
        }

        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        var input = document.querySelector('input[name=tags]');

// initialize Tagify on the above input node reference
new Tagify(input,{
    delimiters: ", ", // Sépare les tags avec des virgules
    maxTags: 5,  
})
        $(document).ready(function() {
            $('#cours').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Traduction française
                }
            });
        });

        $(document).ready(function() {
            $('#tag').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Traduction française
                }
            });
        });

        $(document).ready(function() {
            $('#categorie').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Traduction française
                }
            });
        });
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
