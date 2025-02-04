<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
</head>
<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Dashboard Étudiant</h2>
            </div>
            <nav class="mt-4">
                <a href="#dashboard" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Accueil</a>
                <a href="#mycourses" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes cours</a>
                <a href="#progress" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Ma progression</a>
                <a href="#certificates" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes certificats</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Progress Overview -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="font-bold text-gray-700 mb-4">Ma progression globale</h3>
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-200">
                                Progression
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-gray-600">
                                75%
                            </span>
                        </div>
                    </div>
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                        <div style="width:75%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#B6FFA1]"></div>
                    </div>
                </div>
            </div>

            <!-- Current Courses -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-gray-700 mb-4">Cours en cours</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <h4 class="font-semibold mb-2">JavaScript Avancé</h4>
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="h-2 bg-gray-200 rounded">
                                        <div class="h-2 bg-[#B6FFA1] rounded" style="width: 60%"></div>
                                    </div>
                                </div>
                                <span class="ml-4 text-sm text-gray-600">60%</span>
                            </div>
                            <button class="mt-2 text-blue-500">Continuer</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-gray-700 mb-4">Certificats obtenus</h3>
                    <div class="space-y-4">
                        <div class="border-b