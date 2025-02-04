<?php 
require_once '../autoload.php';
Session::ActiverSession();
if(!isset($_SESSION['userData']['iduser']) || $_SESSION['userData']['role']!=1){
    header('location: connexion.php');
}
$coursId=$_POST['idcours'];
$cours=cours::getcoursById($coursId);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Détails du cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Même navigation que la page précédente -->
    <nav class="bg-[#B6FFA1] shadow-lg">
        <!-- ... Copier la même navigation ... -->
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- En-tête du cours -->
        <div class="bg-[#FFFBE6] rounded-xl p-8 mb-8 shadow-lg">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Image du cours -->
                <div class="md:col-span-1">
                    <img src="<?=$cours->image?>" alt="" class="w-full h-64 object-cover rounded-lg shadow-md">
                </div>
                
                <!-- Informations du cours -->
                <div class="md:col-span-2">
                    <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm"><?=$cours->categorie->getcategorie()?></span>
                    <h1 class="text-3xl font-bold mt-4 mb-4"><?=$cours->titre?></h1>
                    <p class="text-gray-600 mb-6"><?=$cours->description?></p>
        
                    
                    <!-- Tags du cours -->
                    <div class="flex flex-wrap gap-2 mb-6">
                    <?php 
                    $coursactuelle= new cours($cours->idcours,$cours->titre,$cours->description,$cours->image);
                    $tags=$coursactuelle->gettagCour();
                    if(!$tags){echo "pas de tag";}
                    foreach ($tags as $tag){
                    ?>
                          <h1> <?=$tag->getTag();?></h1> 
                 <?php
                    }
                    ?>
                   
                    </div>

                    <!-- Bouton d'inscription -->
                     <?php 
                     $inscripton =new inscrire($coursId,$_SESSION['userData']['iduser']);
                    if(!$inscripton->verifierEtusiantInscrireCours()){
                     ?>
                      <form action="../traitement/traitementEtudiant.php" method="Post">
                          <input type="hidden" name="idetudiant" value="<?=$_SESSION['userData']['iduser']?>">
                          <input type="hidden" name="coursId" value="<?= $coursId ?>">
                          <button type="submit" name="inscrire" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            S'inscrire au cours
                        </button>
                      </form>
                      <?php
                      }
                      ?>
                    
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Section principale du cours -->
            <div class="md:col-span-2">
                <!-- Lecteur vidéo ou contenu du cours -->
                <div class="bg-white rounded-xl p-6 shadow-lg mb-8">
                    <h2 class="text-2xl font-bold mb-4">Contenu du cours</h2>
                    <?php if($cours instanceof coursVedio ): ?>
                        <div class="aspect-w-16 aspect-h-9 mb-4">
                            <video controls class="w-full rounded-lg">
                                <source src="<?=$cours->getvedio()?>" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture vidéo.
                            </video>
                        </div>
                    <?php else: ?>
                        <div class="prose max-w-none">
                          <?php 
                             $contenu = file_get_contents($cours->getdocumentation());
                
                             // Afficher le contenu dans le div
                             echo nl2br(htmlspecialchars($contenu));
                          ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Programme du cours -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Programme</h2>
                    <div class="space-y-4">
                        <?php
                        // $chapters = []; // Fetch chapters from database
                        // foreach($chapters as $index => $chapter):
                        ?>
                        <div class="border-b pb-4">
                            <h3 class="font-semibold">chapitre titre</h3>
                            <p class="text-gray-600">chapitre descriptin </p>
                        </div>
                      
                    </div>
                </div>
            </div>

            <!-- Barre latérale - Informations sur le professeur -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl p-6 shadow-lg sticky top-4">
                    <div class="text-center mb-6">
                        <img src="../images/author-image1.jpg" alt="" 
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-bold"></h3>
                        <p class="text-gray-600"></p>
                    </div>

                    <div class="border-t pt-4">
                        <h4 class="font-bold mb-2">À propos du professeur</h4>
                        <p class="text-gray-600 mb-4"></p>
                        
                        <!-- Statistiques du professeur -->
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-[#FFFBE6] p-3 rounded-lg">
                                <div class="font-bold"></div>
                                <div class="text-sm text-gray-600">Cours</div>
                            </div>
                            <div class="bg-[#FFFBE6] p-3 rounded-lg">
                                <div class="font-bold"></div>
                                <div class="text-sm text-gray-600">Étudiants</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Même footer que la page précédente -->
    <footer class="bg-gray-800 text-white py-20">
        <!-- ... Copier le même footer ... -->
    </footer>
</body>
</html>