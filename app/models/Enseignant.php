<?php 
require_once 'user.php';
require_once 'session.php';


class Enseignant extends user {
    static $cours=[];
    
    public static  function getStatusProf($email){
        $db = database::getInstance()->getConnection();
       try {
        $stmt=$db->prepare("SELECT status from \"user\"  where email=?  ");
        if($stmt->execute([$email])){
            $result =$stmt->fetch();
            return $result['status'] ;
        }else{
            return false;
        }
        
       } catch (PDOException $e) {
           $e->getMessage();
       }
    }

    public static function login($Email,$password){
        $db=database::getInstance()->getConnection();
        try{
           $stmt=$db->prepare("SELECT * From \"user\" where email=?  ");
           if($stmt->execute([$Email])){
               $result = $stmt->fetch();
               if($result['status']=='en attente'){
                Session::validateSession($result);
                $_SESSION['error'] = "votre compte est  en cours de traitement !"; 
//                header('location: ../views/connexion.php');
//                exit();
               }
               if(password_verify($password,$result['password'])){
                    Session::validateSession($result); 
//                    header('location: ../front/mesCours.php');
//                    exit();
               }
               else{
                   Session::ActiverSession();
                   $_SESSION['error'] = "Mot de passe incorrect !"; 
//                   header('location: ../views/connexion.php');
//                   exit();
               }
           }else{
               Session::ActiverSession();
               $_SESSION['error'] = "Mail n'exist pas !"; 
//               header('location: ../views/connexion.php');
//               exit();
           }
        } catch(PDOException $e){
           
        }
   }

   public  function getstatus(){ return $this->status;}


   public function ajouterCours(cours $cours) {
    if ($cours instanceof coursVedio) {
        $result = coursVedio::createCours($cours->titre, $cours->description,$cours->image, null,$cours->getvedio(),  $cours->categorie->getCategorie(), $this->id);
        if (!$result) {
            return "Erreur lors de la création du cours vidéo";
        }
        Enseignant::$cours[]=$result;
        return $result;
    }
    if ($cours instanceof coursDocument) {
        $result = coursDocument::createCours($cours->idcours, $cours->titre, $cours->description,$cours->image, $cours->getdocumentation(),null, $cours->categorie->getCategorie(), $this->id);
        if (!$result) {
            return "Erreur lors de la création du cours document";
        }
        Enseignant::$cours[]=$result;
        return $result;
    }
    return "Type de cours non pris en charge";
}

public function consulterMesCours(cours $cours){
       if($cours instanceof coursVedio){
          return coursVedio::getAllCours($this->id);
       }
       if($cours instanceof coursDocument){
        return coursDocument::getAllCours($this->id);
       }
} 

public static  function  getAllProf(){
    $prof=[];
    $db=database::getInstance()->getConnection();
    try {
        $stmt=$db->prepare("SELECT * FROM \"user\" where role= 2");
       if($stmt->execute())
       {
        $results = $stmt->fetchAll();
        
        foreach ($results as $result) {
            $prof[] = new Enseignant(
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['role'],
                $result['iduser'],
                $result['password'],
                $result['status']
            );
        }
        return $prof;
       }
       return [];
    } catch (\Throwable $th) {
        //throw $th;
    }
}

public function updateStatus($newstatus) {
    $db = database::getInstance()->getConnection();
    try {
        $stmt = $db->prepare("UPDATE \"user\" SET status = ? WHERE iduser = ?");
        $stmt->execute([$newstatus, $this->id]);
        return true; 
    } catch (\Throwable $th) {
        error_log("Erreur dans updateStatus : " . $th->getMessage()); 
        return false; 
    }
}

public function mesEtudiants(){

    $db=database::getInstance()->getConnection();
    try {
        $stmt=$db->prepare("SELECT count(*) as total from inscrire i INNER join cours c on c.idcours=i.idcours where c.idEnseignant=?;");
        $stmt->execute([$this->id]);
        $result = $stmt->fetch();
        if ($result) {
            $total = $result['total']; 
        }
      return $total;  

    } catch (\PDOException $th) {
        die($th->getMessage());
    }
}
 static function top3prof(){
    $db=database::getInstance()->getConnection();
    try {
        $stmt=$db->prepare("SELECT 
    u.iduser AS idEnseignant,
    u.nom AS nomEnseignant,
    COUNT(c.idcours) AS total_cours
FROM 
    user u
LEFT JOIN 
    cours c ON u.iduser = c.idEnseignant
GROUP BY 
    u.iduser
ORDER BY 
    total_cours DESC
LIMIT 3;
");
if($stmt->execute()){
    $result=$stmt->fetchAll();
    return $result;
}
return [];

    } catch (\Throwable $th) {
        //throw $th;
    }

 }





}

