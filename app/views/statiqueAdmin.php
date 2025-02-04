<?php
 require_once '../autoload.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Vue d'ensemble</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Dashboard admin</h2>
            </div>
            <nav class="mt-4">
                <a href="#dashboard" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Vue d'ensemble</a>
                <a href="#courses" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes cours</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes étudiants</a>
                <form action="../traitement/traitementProf.php" method="post">
                    <button name="deconnexion" class="hover:text-gray-600">Déconnexion</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Total Courses Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-medium text-gray-500">Nombre total de cours</p>
                            <h3 class="text-4xl font-bold text-gray-700 mt-2">
                                <?php 
                                echo cours::allcours();
                                ?>
                            </h3>
                        </div>
                        <div class="p-4 bg-[#B6FFA1] rounded-full">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Augmentation mensuelle</span>
                            <span class="text-green-500">+12%</span>
                        </div>
                    </div>
                </div>

                <!-- Most Popular Course -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-500">Cours le plus populaire</h3>
                    <div class="mt-4">
                        <h4 class="text-xl font-semibold text-gray-800">
                            <?php 
                            $cours=cours::cousPlusPopoluare();
                            echo $cours['titre']
                            ?>
                        </h4>
                        <div class="flex items-center mt-2">
                            <img src="../images/author-image1.jpg" alt="Instructeur" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-600">Prof. Sarah Martin</span>
                        </div>
                        <div class="mt-4 flex items-center">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="ml-2 text-gray-600">4.9/5 (328 étudiants)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Category Distribution -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Répartition par catégorie</h3>
                    <div class="h-80">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>

                <!-- Top 3 Teachers -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Top 3 Enseignants</h3>
                    <!-- Teacher 1 -->
                     <?php 
                     $results=Enseignant::top3prof();
                     foreach($results as $prof){
                     ?>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <img src="../images//author-image2.jpg" alt="Teacher 1" class="w-12 h-12 rounded-full">
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800"><?=$prof['nomEnseignant']?></h4>
                                <p class="text-sm text-gray-500">Développement Web</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800"><?=$prof['total_cours']?> cours</p>
                            <p class="text-sm text-gray-500">1,245 étudiants</p>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Category Distribution Chart
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: ['Développement Web', 'Data Science', 'Design', 'Marketing', 'Langues', 'Business'],
                datasets: [{
                    data: [35, 25, 15, 12, 8, 5],
                    backgroundColor: [
                        '#4CAF50',
                        '#2196F3',
                        '#FFC107',
                        '#9C27B0',
                        '#FF5722',
                        '#607D8B'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    </script>
</body>
</html>