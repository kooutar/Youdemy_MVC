<?php
require_once __DIR__.'/../config/db.php';
//require_once __DIR__.'../config/autoloadclasse.php';
class coursVedio extends cours
{
    private $vedio;

    public function __construct($id, $titre, $description,$image, $vedio)
    {
        parent::__construct($id, $titre, $description,$image);
        $this->vedio = $vedio;
    }


    public static function validatepathVedio($vedioName, $vedioTmp)
    {
        $dir = '../uploads/';
        $path = basename($vedioName);
        $finalPath = $dir . uniqid() . "_" . $path;
        $allowedExtensions = ['mp4', 'mov', 'avi', 'wmv', 'flv'];
        $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (move_uploaded_file($vedioTmp, $finalPath)) {
                return $finalPath;
            } else {
                throw new Exception("Erreur lors du déplacement du fichier : $vedioName");
            }
        } else {
            throw new Exception("Extension non autorisée pour le fichier : $vedioName");
        }
    }


    public static function createCours($titre, $description,$image,$doc,$vedio, $idcategorie, $idEnseignant)
    {
        $db = database::getInstance()->getConnection();
        try {
            $stmt = $db->prepare("INSERT into cours(titre,description,path_image,path_vedio,idcategorie,idEnseignant) 
                              values(?,?,?,?,?,?)");
            $stmt->execute([$titre, $description,$image, $vedio, $idcategorie, $idEnseignant]);
            $lastInsertId = $db->lastInsertId();
            return new coursVedio($lastInsertId, $titre, $description,$image, $vedio);
        } catch (PDOException $th) {
            echo "Erreur PDO : " . $th->getMessage(); 
        return false; 
        }
    }
    public static function getAllCours($idEnseignant){
        $db=database::getInstance()->getConnection();
        $courses=[];
        try{
       $stmt=$db->prepare("SELECT * FROM  vuecours2 where documentation is null and iduser=? ");
       if($stmt->execute([$idEnseignant])){
         $result=$stmt->fetchALL();
         foreach($result as $row){
            $course= new coursVedio($row['idcours'],$row['titre'],$row['description'],$row['path_image'],$row['path_vedio']);
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

    public function getvedio()
    {
        return $this->vedio;
    }

    public static function totalCousVedio($idprof) {
        $total = 0;
        $db = database::getInstance()->getConnection();
    
        try {
            // Préparer la requête
            $stmt = $db->prepare("SELECT COUNT(*) AS total FROM cours WHERE documentation IS NULL AND idEnseignant = ?");
            
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
