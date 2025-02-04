<?PHP
class Session {
    public static function ActiverSession(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function validateSession($userData) {
           Session::ActiverSession();
           if (!$userData) {
            throw new Exception("Aucune donnée utilisateur trouvée.");
        }
    
        // Stocker toutes les informations utilisateur dans la session
        $_SESSION['userData'] = $userData;
    
        // Vérifier si la session est correctement configurée
        if (empty($_SESSION['userData'])) {
            throw new Exception("Utilisateur non connecté.");
        }
    
        return $_SESSION['userData'];
    

    }

//  public function destroySession(){
//     session_unset();
//     session_destroy();
//  }
}