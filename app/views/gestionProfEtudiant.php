<?php 
require_once '../autoload.php';
session::ActiverSession();
if(!isset($_SESSION['userData']['iduser']) || $_SESSION['userData']['role']!=3){
    header('location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Gestion des Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
                <a href="gestionCentenu.php" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Gestion Contenu</a>
                <a href="#users" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Gestion Utilisateurs</a>
                <form action="../traitement/traitementAdmin.php" method="post">
                    <button name="deconnexion" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Déconnexion</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Buttons Section -->
            <div class="mb-6 flex flex-wrap gap-4">
                <button onclick="showTable('professeursTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Professeurs
                </button>
                <button onclick="showTable('etudiantsTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Étudiants
                </button>
            </div>

            <!-- Professeurs Table Section -->
            <div id="professeursTable" class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-4">Liste des Professeurs</h3>
                <table id="tableProfesseurs" class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left">Photo</th>
                            <th class="p-3 text-left">Nom</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Spécialité</th>
                            <th class="p-3 text-left">Statut</th>
                            <th class="p-3 text-left">Date d'inscription</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $arryprof=Enseignant::getAllProf();
                         foreach($arryprof as $prof){
                          
                      
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <img src="../images/author-image4.jpg" class="w-10 h-10 rounded-full" alt="Prof">
                            </td>
                            <td class="p-3"><?= $prof->nom?></td>
                            <td class="p-3"><?=$prof->email?></td>
                            <td class="p-3">Développement Web</td>
                            <td class="p-3">
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded"><?=$prof->status?></span>
                            </td>
                            <td class="p-3">2024-01-17</td>
                            <td class="p-3 flex">
                                <form action="../traitement/traitementAdmin.php" method="post">
                                    <input type="hidden" name="status"  value="accepter">
                                    <input type="hidden" name="nom" value="<?= $prof->nom?>">
                                    <input type="hidden" name="prenom" value="<?= $prof->prenom?>">
                                    <input type="hidden" name="email" value="<?= $prof->email?>">
                                    <input type="hidden" name="role" value="<?= $prof->role?>">
                                    <input type="hidden" name="iduser" value="<?= $prof->id?>">
                                    <input type="hidden" name="password" value="<?= $prof->password?>">
                                 
                                    <button name="accepterProf" class="bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600">
                                    Accepter
                                  </button>
                                </form>
                                <form action="../traitement/traitementAdmin.php" method="post">
                                    <input type="hidden" name="status"  value="refuser">
                                    <input type="hidden" name="nom" value="<?= $prof->nom?>">
                                    <input type="hidden" name="prenom" value="<?= $prof->prenom?>">
                                    <input type="hidden" name="email" value="<?= $prof->email?>">
                                    <input type="hidden" name="role" value="<?= $prof->role?>">
                                    <input type="hidden" name="iduser" value="<?= $prof->id?>">
                                    <input type="hidden" name="password" value="<?= $prof->password?>">
                                <button name ="refuseProf" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Refuser
                                </button>
                                </form>
                                
                            </td>
                        </tr>
                        <?php
                           } 
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Étudiants Table Section -->
            <div id="etudiantsTable" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
                <h3 class="font-bold text-gray-700 mb-4">Liste des Étudiants</h3>
                <table id="tableEtudiants" class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left">Photo</th>
                            <th class="p-3 text-left">Nom</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Cours suivis</th>
                            <th class="p-3 text-left">Statut</th>
                            <th class="p-3 text-left">Date d'inscription</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $etudiants=Etudiant::getAlletudiants();
                        foreach($etudiants as $etudiant){
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <img src="../images/author-image4.jpg" class="w-10 h-10 rounded-full" alt="Student">
                            </td>
                            <td class="p-3"><?= $etudiant->nom?></td>
                            <td class="p-3"><?= $etudiant->email?></td>
                            <td class="p-3">3</td>
                            <td class="p-3">
                                <?php if($etudiant->status==1) {?>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                                <?php }?>
                                <?php if($etudiant->status!=1) {?>
                                <span class="bg-red-100 text-green-800 px-2 py-1 rounded">banir</span>
                               <?php }?>
                            </td>
                            <td class="p-3">2024-01-15</td>
                            <td class="p-3">
                            <?php if($etudiant->status!=1) {?>
                                <form action="../traitement/traitementAdmin.php" method="post">
                                    <input type="hidden" name="nom" value="<?= $etudiant->nom?>">
                                    <input type="hidden" name="prenom" value="<?= $etudiant->prenom?>">
                                    <input type="hidden" name="email" value="<?= $etudiant->email?>">
                                    <input type="hidden" name="role" value="<?= $etudiant->role?>">
                                    <input type="hidden" name="iduser" value="<?= $etudiant->id?>">
                                    <input type="hidden" name="password" value="<?= $etudiant->password?>">
                                <button name="debanire" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-red-600" >
                                    Debanire
                                </button>
                                </form>
                                <?php }?>
                                <?php if($etudiant->status==1) {?>
                                    <form action="../traitement/traitementAdmin.php" method="post">
                                    <input type="hidden" name="nom" value="<?= $etudiant->nom?>">
                                    <input type="hidden" name="prenom" value="<?= $etudiant->prenom?>">
                                    <input type="hidden" name="email" value="<?= $etudiant->email?>">
                                    <input type="hidden" name="role" value="<?= $etudiant->role?>">
                                    <input type="hidden" name="iduser" value="<?= $etudiant->id?>">
                                    <input type="hidden" name="password" value="<?= $etudiant->password?>">
                                <button name="banire" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" >
                                    Banire
                                </button>
                                </form>
                                <?php }?>
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

    <script>
        $(document).ready(function() {
            // Initialisation des DataTables
            $('#tableProfesseurs').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                },
                responsive: true,
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rtip',
                initComplete: function() {
                    $('.dataTables_length select').addClass('border rounded px-2 py-1');
                    $('.dataTables_filter input').addClass('border rounded px-2 py-1 ml-2');
                }
            });

            $('#tableEtudiants').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                },
                responsive: true,
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rtip',
                initComplete: function() {
                    $('.dataTables_length select').addClass('border rounded px-2 py-1');
                    $('.dataTables_filter input').addClass('border rounded px-2 py-1 ml-2');
                }
            });
        });

        function showTable(tableId) {
            // Cacher toutes les tables
            ['professeursTable', 'etudiantsTable'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            // Afficher la table sélectionnée
            document.getElementById(tableId).classList.remove('hidden');
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