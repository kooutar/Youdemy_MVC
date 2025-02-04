<?php
require_once '../autoload.php';
Session::ActiverSession(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Statistiques</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Dashboard Professeur</h2>
            </div>
            <nav class="mt-4">
                <a href="#dashboard" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Tableau de bord</a>
                <a href="mesCours.php" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes cours</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes étudiants</a>
                <form action="../traitement/traitementProf.php" method="post">
                    <button name="deconnexion" class="hover:text-gray-600">Déconnexion</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Étudiants -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-[#B6FFA1] rounded-full">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Étudiants</p>
                            <h3 class="text-2xl font-bold text-gray-700">
                            <?php
                             $prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
                             $total=$prof->mesEtudiants();
                               echo $total;
                                ?> 
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Total Cours -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-[#B6FFA1] rounded-full">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Cours</p>
                            <h3 class="text-2xl font-bold text-gray-700">
                            <?php
                               $totale= cours::totalCous($_SESSION['userData']['iduser']);
                               echo $totale;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Cours Vidéo -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-[#B6FFA1] rounded-full">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cours Vidéo</p>
                            <h3 class="text-2xl font-bold text-gray-700">
                                <?php
                               $totale= coursVedio::totalCousVedio($_SESSION['userData']['iduser']);
                               echo $totale;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Cours Document -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-[#B6FFA1] rounded-full">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cours Document</p>
                            <h3 class="text-2xl font-bold text-gray-700">
                            <?php
                               $totale= coursDocument::totalCousDocument($_SESSION['userData']['iduser']);
                               echo $totale;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Line Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Évolution des Étudiants et Cours</h3>
                    <div class="h-80">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Types de Cours par Mois</h3>
                    <div class="h-80">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr'],
                datasets: [
                    {
                        label: 'Étudiants',
                        data: [65, 72, 85, 93],
                        borderColor: '#4CAF50',
                        tension: 0.1
                    },
                    {
                        label: 'Cours',
                        data: [4, 6, 8, 9],
                        borderColor: '#2196F3',
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr'],
                datasets: [
                    {
                        label: 'Cours Vidéo',
                        data: [3, 4, 5, 6],
                        backgroundColor: '#4CAF50'
                    },
                    {
                        label: 'Cours Document',
                        data: [1, 2, 3, 3],
                        backgroundColor: '#2196F3'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>



