<?php
require_once __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../config/config.php';
session::ActiverSession();
if (isset($_SESSION['error'])) {
    $Message = $_SESSION['error'];
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: '$Message',
                confirmButtonText: 'OK',
                timer: 5000
            });
        </script>
    ";
    unset($_SESSION['error']); 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Authentification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFFBE6] min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-[#B6FFA1] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.html" class="text-2xl font-bold">Youdemy</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Authentication Pages Container -->
    <div class=" w-full flex  justify-center">
        <div class="p-4">
            

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-3xl font-bold mb-8 text-center">Inscription</h2>
                <form class="space-y-6" action="<?= URL?>/AuthControllers/register" method="POST">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                            <input 
                                type="text" 
                                name="nom"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]"
                                placeholder="Votre nom"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                            <input 
                                type="text" 
                                name="prenom"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]"
                                placeholder="Votre prénom"
                                required
                            >
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email"
                            name="email" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]"
                            placeholder="votre@email.com"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <input 
                            type="password" 
                            name="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]"
                            placeholder="••••••••"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input 
                            type="password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]"
                            placeholder="••••••••"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                        <select name="role" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]" require>
                            <option value="1">Étudiant</option>
                            <option value="2">Enseignant</option>
                        </select>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-green-600 rounded border-gray-300" required>
                        <label class="ml-2 text-sm text-gray-600">
                            J'accepte les <a href="#" class="text-green-600 hover:text-green-700">conditions d'utilisation</a>
                        </label>
                    </div>
                    <button 
                        type="submit" 
                        name="inscrire"
                        class="w-full py-3 px-4 bg-[#B6FFA1] hover:bg-green-200 rounded-lg text-black font-medium transition-colors duration-200"
                    >
                        Créer mon compte
                    </button>
                </form>
                <div class="mt-6 text-center text-sm text-gray-600">
                    Déjà un compte ? 
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Se connecter</a>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p>&copy; 2024 EduLearn. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>

