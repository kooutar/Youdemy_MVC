<?php 
require_once 'user.php';
require_once 'session.php';
 class Etudiant extends user{

    public static function login($Email,$password){
         $db=database::getInstance()->getConnection();
         try{
            $stmt=$db->prepare("SELECT * From \"user\" where email=? ");
            if($stmt->execute([$Email])){
                $result = $stmt->fetch(); 
//                if($result['EstActive']==false){
//                    Session::validateSession($result);
//                    $_SESSION['error'] = "votre compte est  Binder !";
//                    header('location: ../views/connexion.php');
//                    exit();
//                   }
                if(password_verify($password,$result['password'])){
                     Session::validateSession($result); 
//                     header('location: ../views/cours.php');
//                     exit();
                }
                else{
                    Session::ActiverSession();
                    $_SESSION['error'] = "Mot de passe incorrect !"; 
                    header('location: ../views/connexion.php');
                    exit();
                }
            }else{
                Session::ActiverSession();
                $_SESSION['error'] = "Mail n'exist pas !"; 
                header('location: ../front/connexion.php'); 
                exit();
            }
           
            
           
         } catch(PDOException $e){
            
         }
    }

    
public static  function  getAlletudiants(){
    $etudiants=[];
    $db=database::getInstance()->getConnection();
    try {
        $stmt=$db->prepare("SELECT * FROM \"user\"  where role= 1");
       if($stmt->execute())
       {
        $results = $stmt->fetchAll();
        
        foreach ($results as $result) {
            // Crée un nouvel objet Enseignant pour chaque ligne de résultat
            $etudiants[] = new Enseignant(
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['role'],
                $result['iduser'],
                $result['password'],
                $result['EstActive']
            );
        }
        return $etudiants;
       }
       return [];
    } catch (\Throwable $th) {
        //throw $th;
    }
}

public function updateStatusEtudiant($newstatus) {
    $db = database::getInstance()->getConnection();
    try {
        $stmt = $db->prepare("UPDATE \"user\"  SET EstActive = ? WHERE iduser = ?");
        $stmt->execute([$newstatus, $this->id]);
        return true; // Retourne true si l'opération a réussi
    } catch (\Throwable $th) {
        error_log("Erreur dans updateStatus : " . $th->getMessage()); // Log l'erreur
        return false; // Retourne false en cas d'erreur
    }
}

public function mescours() {
  $mescours = [];
    $db = database::getInstance()->getConnection();

    try {
        // Préparer la requête SQL
        $stmt = $db->prepare("
            SELECT c.* 
            FROM cours c 
            INNER JOIN inscrire i ON c.idcours = i.idcours 
            INNER JOIN user u ON u.iduser = i.idEtudiant 
            WHERE i.idEtudiant = ?
        ");

        
       if( $stmt->execute([$this->id])){
        $results = $stmt->fetchAll();

        
        foreach ($results as $result) {
            $mescours[] = new cours(
                $result['idcours'],
                $result['titre'],
                $result['description'],
                $result['path_image']
            );
        }
        return $mescours;
       }else{
        return [];
       }

        

    } catch (Throwable $th) {
        // Log l'erreur pour le debug
        error_log("Erreur dans mescours : " . $th->getMessage());
        return false; // Retourne false en cas d'erreur
    }

    return $mescours; // Retourne la liste des cours
}


 }

 
 

?>