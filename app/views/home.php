
<?php

require_once(__DIR__ . '/../config/config.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Plateforme E-learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFFBE6]">
<!-- Navigation Bar -->
<nav class="bg-[#B6FFA1] shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold">Youdemy</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="hover:text-gray-600">Accueil</a>
                <a href="app/views/cours.php" class="hover:text-gray-600">Cours</a>
                <a href="#" class="hover:text-gray-600">Catégories</a>
                <a href="#" class="hover:text-gray-600">Enseignants</a>
            </div>

            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 rounded-lg bg-white hover:bg-gray-100">
                    <a href="<?= URL ?>/AuthControllers/connection">Connexion</a>
                </button>
                <button class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                    <a href="<?= URL ?>/AuthControllers/render">Inscription</a>

                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="bg-[#B6FFA1] py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <h1 class="text-5xl font-bold leading-tight">
                    Découvrez une nouvelle façon d'apprendre
                </h1>
                <p class="text-xl text-gray-700">
                    Rejoignez notre communauté d'apprenants et transformez votre avenir avec des cours en ligne de qualité.
                </p>
                <div class="flex space-x-4">
                    <button class="px-8 py-4 rounded-xl bg-green-600 text-white hover:bg-green-700">
                        Commencer maintenant
                    </button>
                    <button class="px-8 py-4 rounded-xl border-2 border-green-600 hover:bg-green-50">
                        Voir les cours
                    </button>
                </div>
            </div>
            <div class="relative">
                <img src="public/images/slider-image1.jpg" alt="Education" class="rounded-2xl shadow-xl">
                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-lg shadow-lg">
                    <p class="font-bold">+1000 Étudiants satisfaits</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold">Pourquoi nous choisir ?</h2>
            <p class="text-gray-600 mt-4">Découvrez ce qui rend notre plateforme unique</p>
        </div>
        <div class="grid md:grid-cols-3 gap-12">
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 bg-[#B6FFA1] rounded-lg mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Cours flexibles</h3>
                <p class="text-gray-600">Apprenez à votre rythme avec un accès illimité aux cours</p>
            </div>
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 bg-[#B6FFA1] rounded-lg mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Support actif</h3>
                <p class="text-gray-600">Une équipe dédiée pour répondre à vos questions</p>
            </div>
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 bg-[#B6FFA1] rounded-lg mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Certification</h3>
                <p class="text-gray-600">Obtenez des certificats reconnus par l'industrie</p>
            </div>
        </div>
    </div>
</div>

<!-- Popular Courses -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Cours populaires</h2>
            <a href="#" class="text-green-600 hover:text-green-700">Voir tout →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-[#FFFBE6] rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="public/images/courses-image1.jpg" alt="course" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm">Développement</span>
                    <h3 class="text-xl font-bold mt-4">Introduction au développement web</h3>
                    <p class="text-gray-600 mt-2">Apprenez les bases du développement web moderne</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold">49.99 €</span>
                        <button class="px-4 py-2 bg-[#B6FFA1] rounded-lg hover:bg-green-200">
                            En savoir plus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-[#FFFBE6] rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="public/images/courses-image2.jpg" alt="course" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm">Design</span>
                    <h3 class="text-xl font-bold mt-4">Design UX/UI Avancé</h3>
                    <p class="text-gray-600 mt-2">Maîtrisez les principes du design moderne</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold">59.99 €</span>
                        <button class="px-4 py-2 bg-[#B6FFA1] rounded-lg hover:bg-green-200">
                            En savoir plus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-[#FFFBE6] rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="public/images/courses-image3.jpg" alt="course" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm">Marketing</span>
                    <h3 class="text-xl font-bold mt-4">Marketing Digital</h3>
                    <p class="text-gray-600 mt-2">Stratégies de marketing pour 2024</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold">39.99 €</span>
                        <button class="px-4 py-2 bg-[#B6FFA1] rounded-lg hover:bg-green-200">
                            En savoir plus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="py-20 bg-[#B6FFA1]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Restez informé</h2>
        <p class="text-gray-700 mb-8">Recevez les dernières actualités et mises à jour de nos cours</p>
        <form class="flex gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Votre email" class="flex-1 px-4 py-3 rounded-lg">
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                S'inscrire
            </button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">EduLearn</h3>
                <p class="text-gray-400">La plateforme d'apprentissage qui vous accompagne vers la réussite.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Liens rapides</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">À propos</a></li>
                    <li><a href="#" class="hover:text-white">Cours</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">FAQ</a></li>
                    <li><a href="#" class="hover:text-white">Aide</a></li>
                    <li><a href="#" class="hover:text-white">Politique de confidentialité</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>Email: contact@edulearn.com</li>
                    <li>Tél: +33 1 23 45 67 89</li>
                    <li>Adresse: Paris, France</li>
                </ul>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-gray-700 text-center text-gray-400">
            <p>&copy; 2024 EduLearn. Tous droits réservés.</p>
        </div>
    </div>
</footer>
</body>
</html>