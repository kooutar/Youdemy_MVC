
<?php
require_once __DIR__.'/../config/autoload.php';
class AuthControllers{
    function register(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if($_POST['role']=='1'){
                    $etudiant = new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],1,null,$_POST['password']);
                    $etudiant::inscrire($etudiant->nom,$etudiant->prenom,$etudiant->email,$etudiant->role,$etudiant->password);
               
            }else{
                $Enseignant=new Enseignant($_POST['nom'],$_POST['prenom'],$_POST['email'],2,null,$_POST['password']);
                $Enseignant::inscrire($Enseignant->nom,$Enseignant->prenom,$Enseignant->email,$Enseignant->role,$Enseignant->password);   
            } 
           
        }
        $this->redrectionConnection();
        // var_dump($_POST);  // Affiche les données envoyées
        // die();
        
    }

    function render(){
        require_once __DIR__.'/../views/registre.php';
    }

    function redrectionConnection(){
        require_once __DIR__.'/../views/connexion.php';
    }
    
}