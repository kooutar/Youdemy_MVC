
<?php
require_once __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../config/autoloadclasse.php';
class AuthControllers{
    function register(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if($_POST['role']=='1'){
                    $etudiant = new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],1,null,$_POST['password']);
                    $etudiant::inscrire($etudiant->nom,$etudiant->prenom,$etudiant->email,$etudiant->role,$etudiant->password);
                    $this->connection();
            }else{
                $Enseignant=new Enseignant($_POST['nom'],$_POST['prenom'],$_POST['email'],2,null,$_POST['password']);
                $Enseignant::inscrire($Enseignant->nom,$Enseignant->prenom,$Enseignant->email,$Enseignant->role,$Enseignant->password);
                 $this->connection();
            }
        }
    }

    function render(){
        require_once __DIR__.'/../views/registre.php';
    }

    function connection(){
        require_once __DIR__.'/../views/connexion.php';
    }

    function login()
    {

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $role= user::RoleMail($_POST['email']);

            if($role){
                if($role=='1'){
                    Etudiant::login($_POST['email'],$_POST['password']);
                    $this->versPageEtudiant();
                }
                if($role =='2' ){
                    Enseignant::login($_POST['email'],$_POST['password']);
                    $this->versPageEnseignant();
                }else{
                    admin::login($_POST['email'],$_POST['password']);
                    $this->versPageAdmin();
                }
            }
        }
    }

    function versPageEtudiant()
    {
       require_once __DIR__.'/../views/cours.php';
    }
    function versPageEnseignant(){
        require_once __DIR__.'/../views/mesCours.php';
    }
    function versPageAdmin(){
        require_once __DIR__.'/../views/gestionCentenu.php';
    }
}