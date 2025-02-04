<?php
require_once __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body class="bg-[#FFFBE6] min-h-screen">
<nav class="bg-[#B6FFA1] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.html" class="text-2xl font-bold">Youdemy</a>
                </div>
            </div>
        </div>
    </nav>
<div class="w-full flex  justify-center">
<div class="p-4">
<div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-3xl font-bold mb-8 text-center">Connexion</h2>
                <form class="space-y-6" action="<?= URL ?>/AuthControllers/login" method="POST">
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
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-green-600 rounded border-gray-300">
                            <label class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                        </div>
                        <a href="#" class="text-sm text-green-600 hover:text-green-700">Mot de passe oublié ?</a>
                    </div>
                    <button 
                        type="submit" 
                        name="connecter"
                        class="w-full py-3 px-4 bg-[#B6FFA1] hover:bg-green-200 rounded-lg text-black font-medium transition-colors duration-200"
                    >
                        Se connecter
                    </button>
                </form>
                <div class="mt-6 text-center text-sm text-gray-600">
                    Pas encore de compte ? 
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">S'inscrire</a>
                </div>
            </div>
</div>
</div>
<footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p>&copy; 2024 EduLearn. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>

<?php
require_once __DIR__.'/../config/autoloadclasse.php';
Session::ActiverSession();
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