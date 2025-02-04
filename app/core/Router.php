<?php

class Router {
    protected $currentController = 'HomeController'; // Contrôleur par défaut
    protected $currentMethod = 'index'; // Méthode par défaut
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();
       
        
        // Vérifier si un contrôleur correspondant existe
        if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
            $this->currentController = $url[0];          
            unset($url[0]);
        }
        
        // Inclure le contrôleur
        require_once __DIR__ . '/../controllers/'. $this->currentController . '.php';
         
        // Instancier le contrôleur
        $this->currentController = new $this->currentController;

        // Vérifier si une méthode est définie dans le contrôleur
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        // Récupérer les paramètres restants
        $this->params = $url ? array_values($url) : [];

        // Appeler la méthode avec les paramètres
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    private function getUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
