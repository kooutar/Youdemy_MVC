<?php
require_once '../classes/session.php';
session::ActiverSession();
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
// else{
//     echo "vide";
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
</head>
<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Admin Dashboard</h2>
            </div>
            <nav class="mt-4">
                <a href="#stats" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Statistiques</a>
                <a href="#courses" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Cours</a>
                <a href="#teachers" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Professeurs</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Étudiants</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Cours</h3>
                    <p class="text-3xl font-bold text-gray-800">156</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Étudiants</h3>
                    <p class="text-3xl font-bold text-gray-800">2,450</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Professeurs</h3>
                    <p class="text-3xl font-bold text-gray-800">48</p>
                </div>
            </div>

            <!-- Chart -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="font-bold text-gray-700 mb-4">Inscriptions mensuelles</h3>
                <div class=" flex justify-center gap-4">
                <button id='ajoutCategorie' class="bg-[#B6FFA1] px-4 py-2 rounded-lg">Ajouter categorie</button>
                <button  id="ajoutTag" class="bg-[#B6FFA1] px-4 py-2 rounded-lg" >Ajouter tag</button>  
                </div>
                <!-- <canvas id="enrollmentChart" height="100"></canvas> -->
            </div>

            <!-- Courses Table -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Liste des Cours</h3>
                    <!-- <button class="bg-[#B6FFA1] px-4 py-2 rounded-lg">Ajouter un cours</button> -->
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Titre</th>
                            <th class="text-left py-2">Professeur</th>
                            <th class="text-left py-2">Étudiants</th>
                            <th class="text-left py-2">Prix</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2">JavaScript Avancé</td>
                            <td>Jean Dupont</td>
                            <td>45</td>
                            <td>49.99€</td>
                            <td>
                                <button class="text-blue-500">Éditer</button>
                                <button class="text-red-500 ml-2">Supprimer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
 <!-- modale tag -->
    <div  id='modaletag' class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
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
    <!-- modale categorie -->
    <div  id='modale' class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <!-- Modal -->
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4">
            <!-- Modal Header -->
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Ajouter une nouvelle Catégorie</h3>
                <button class="text-gray-600 hover:text-gray-800" onclick="closeModal()">
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
                            Categorie
                        </label>
                        <input 
                            type="text" 
                            name="categorie"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent"
                            placeholder="ex: JavaScript pour débutants"
                        >
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <button name="ajoutCategorie" class="px-4 py-2 bg-[#B6FFA1] text-gray-700 rounded-md hover:bg-opacity-80">
                                    ➕ Ajouter une Catégorie
                                </button>
                        
                </form>
            </div>
        </div>
    </div>

   

   

    <script>
          let btecetgorie=document.getElementById('ajoutCategorie');
          let ajoutTag =document.getElementById('ajoutTag');
          btecetgorie.addEventListener('click',()=>{
        document.getElementById('modale').classList.remove('hidden');
       })


       ajoutTag.addEventListener('click',()=>{
      document.getElementById('modaletag').classList.remove('hidden');
       })

       function closeModal() {
        document.getElementById('modale').classList.add('hidden');
}

function closeModal2() {
    document.getElementById('modaletag').classList.add('hidden');
}

var input = document.querySelector('input[name=tags]');

// initialize Tagify on the above input node reference
new Tagify(input,{
    delimiters: ", ", // Sépare les tags avec des virgules
    maxTags: 5,  
})
    </script>
</body>
</html>

