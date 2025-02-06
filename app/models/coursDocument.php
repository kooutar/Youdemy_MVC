<?php
require_once __DIR__.'/../config/db.php';
//require_once 'cours.php';
class coursDocument extends cours{
      private $documentation;

      public function __construct($id,$titre,$description,$image,$documentation)
      {
        parent::__construct($id,$titre,$description,$image);
        $this->documentation=$documentation;
      }

      public static function validateDocument($documentName,$documentTmp){
          $dir = __DIR__ . "/../../public/Uploads/document/"; // Chemin absolu
          if (!is_dir($dir)) {
              mkdir($dir, 0777, true); // Créer le dossier s'il n'existe pas
          }
        $path = basename($documentName);
        $finalPath = $dir . uniqid() . "_" . $path;
        $allowedExtensions = ['txt', 'doc', 'pdf'];
        $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (move_uploaded_file($documentTmp, $finalPath)) {
                return $finalPath;
            } else {
                throw new Exception("Erreur lors du déplacement du fichier : $documentName");
            }
        } else {
            throw new Exception("Extension non autorisée pour le fichier : $documentName");
        }

      }

    public static function createCours($id,$titre,$description,$image,$documentation,$vedio,$idcategorie,$idEnseignant){
        $db=database::getInstance()->getConnection();
        try {
           $stmt=$db->prepare("INSERT into cours(titre,description,path_image,documentation,idcategorie,idEnseignant) 
                              values(?,?,?,?,?,?)");
            $stmt->execute([$titre,$description,$image,$documentation,$idcategorie,$idEnseignant]);
            $lastInsertId=$db->lastInsertId();
            return new coursDocument($lastInsertId,$titre,$description,$image,$documentation);
        } catch (PDOException $th) {
           $th->getMessage();
        }
    }

    
    public static function getAllCours($idEnseignant){
        $db=database::getInstance()->getConnection();
        $courses=[];
        try{
       $stmt=$db->prepare("SELECT * FROM  vuecours2 where path_vedio is null and iduser=?");
       if($stmt->execute([$idEnseignant])){
         $result=$stmt->fetchALL();
         foreach($result as $row){
            $course= new coursDocument($row['idcours'],$row['titre'],$row['description'],$row['path_image'],$row['documentation']);
            $prof=new Enseignant($row['nom'],$row['prenom'],$row['email'],$row['role'],$row['iduser'],$row['password']);
            $course->setProfessor($prof);
            $categorie=new categorie($row['categorie']);
            $course->setCategorie( $categorie);
            $courses[]=$course;
         }
         return $courses;
       }
   
       return [];

        }catch(PDOException $e)
        {
            die("Erreur SQL : " . $e->getMessage());
        }
       
    }


     public function getdocumentation(){return $this->documentation;} 

     public static function totalCousDocument($idprof) {
        $total = 0;
        $db = database::getInstance()->getConnection();
    
        try {
            // Préparer la requête
            $stmt = $db->prepare("SELECT COUNT(*) AS total FROM cours WHERE path_vedio IS NULL AND idEnseignant = ?");
            
            // Exécuter la requête
            $stmt->execute([$idprof]);
            
            // Récupérer le résultat
            $result = $stmt->fetch();
            if ($result) {
                $total = $result['total']; // Récupérer la valeur de la colonne 'total'
            }
            
        } catch (PDOException $e) {
            // Afficher ou enregistrer l'erreur
            error_log("Erreur lors de la récupération du total des cours vidéo : " . $e->getMessage());
        }
    
        // Retourner le total
        return $total;
    }
    
}