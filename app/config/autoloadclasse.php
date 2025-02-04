<?php
spl_autoload_register(function ($className) {
    $file = __DIR__ . '../Models/' . $className . '.php'; 
    if (file_exists($file)) {
        require_once $file;
    } else {
        die("La classe {$className} n'a pas été trouvée.");
    }
});