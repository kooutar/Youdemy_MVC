<?php 
 require_once '../autoload.php';
 session::ActiverSession();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>


</head>

<body class="bg-[#FFFBE6]">
    <div class="flex">
  
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Dashboard Professeur</h2>
            </div>
            <nav class="mt-4">
                <a href="#dashboard" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Tableau de bord</a>
                <a href="#courses" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes cours</a>
                <a href="#students" onclick="showSection('sectionMesEtudiant')" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes étudiants</a>
                <a href="#earnings" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes gains</a>
            </nav>
        </aside>

       
        <main class="flex-1 p-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Mes Cours</h3>
                    <p class="text-3xl font-bold text-gray-800">12</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Étudiants</h3>
                    <p class="text-3xl font-bold text-gray-800">245</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Gains ce mois</h3>
                    <p class="text-3xl font-bold text-gray-800">1,250€</p>
                </div>
            </div>

            <!-- My Courses -->
            <div class="section bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Mes Cours</h3>
                    <button id="bteAjoutCours" class="bg-[#B6FFA1] px-4 py-2 rounded-lg">Nouveau cours</button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Titre</th>
                            <th class="text-left py-2">Étudiants</th>
                            <th class="text-left py-2">Revenus</th>
                            <th class="text-left py-2">Statut</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        var_dump( Enseignant::$cours);
                        ?>
                        <tr class="border-b">
                            <td class="py-2">Python pour débutants</td>
                            <td>32</td>
                            <td>850€</td>
                            <td><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span></td>
                            <td>
                                <button class="text-blue-500">Éditer</button>
                                <button class="text-red-500 ml-2">Archiver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Students List -->
            <div class="section bg-white rounded-lg shadow-md p-6">
                <h3 class="font-bold text-gray-700 mb-4">Derniers étudiants inscrits</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b pb-2">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" class="rounded-full" alt="Student">
                            <div class="ml-4">
                                <p class="font-semibold">Marie Lambert</p>
                                <p class="text-sm text-gray-600">Python pour débutants</p>
                            </div>
                        </div>
                        <button class="text-blue-500">Contacter</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
  <!-- section    -->
 <section id='sectionMesEtudiant' class="section hidden">

 <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-bold text-gray-700 mb-4">Derniers étudiants inscrits</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b pb-2">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" class="rounded-full" alt="Student">
                            <div class="ml-4">
                                <p class="font-semibold">Marie Lambert</p>
                                <p class="text-sm text-gray-600">Python pour débutants</p>
                            </div>
                        </div>
                        <button class="text-blue-500">Contacter</button>
                    </div>
                </div>
            </div>
  
 </section>
  





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
                        <select onchange="afficherChamps()" id="typeCours" name="typeCours"   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
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

    <script>
       let bteAjoutCours=document.getElementById('bteAjoutCours');
       bteAjoutCours.addEventListener('click',()=>{
        document.getElementById('modale').classList.remove('hidden');
       })

       function closeModal() {
        document.getElementById('modale').classList.add('hidden');
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
function afficherChamps() {
            var typeCours = document.getElementById('typeCours').value;
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