<?php



require_once __DIR__.'/../config/db.php';
require_once 'Enseignant.php';
require_once 'categorie.php';
class  cours
{
  protected $idcours;
  protected $titre;
  protected $description;
  protected $image;
  protected $status;
  protected Enseignant $prof;
  protected categorie $categorie;

  public function __construct($id, $titre, $description, $image,$status='en attente')
  {
    $this->idcours = $id;
    $this->titre = $titre;
    $this->description = $description;
    $this->image = $image;
    $this->status=$status;
  }

  public static function validateImage($imagename, $imageTmp)
  {
      $dir = __DIR__ . "/../../public/Uploads/cours/"; // Chemin absolu
      if (!is_dir($dir)) {
          mkdir($dir, 0777, true); // Créer le dossier s'il n'existe pas
      }
    $path = basename($imagename);
    $finalPath = $dir . uniqid() . "_" . $path;
    $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
    $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
    if (in_array(strtolower($extension), $allowedExtensions)) {
      if (move_uploaded_file($imageTmp, $finalPath)) {
        return $finalPath;
      } else {
        throw new Exception("Erreur lors du déplacement du fichier : $imagename");
      }
    } else {
      throw new Exception("Extension non autorisée pour le fichier : $imagename");
    }
  }

  public function __get($attribut)
  {

    if (property_exists($this, $attribut)) {
      return $this->$attribut;
    } else {

      echo "L'attribut '$attribut' n'existe pas.";
    }
  }
  public function setProfessor(Enseignant $professor)
  {
    $this->prof = $professor;
  }
  public function setCategorie(categorie $categorie)
  {
    $this->categorie = $categorie;
  }
  // public static function getTotalCours(){

  // }
  public static function totalcours()
  {
    $db = Database::getInstance()->getConnection();
    try {
      $req = "SELECT COUNT(*) as total FROM cours where status='accepter'";
      $stmt = $db->prepare($req);
      $stmt->execute();
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo "Erreur lors du comptage des cours : " . $e->getMessage();
      return [];
    }
  }

  public static function getTousCours()
  {
    $courses = [];
    $db = Database::getInstance()->getConnection();
    try {
      $req = "SELECT * FROM  vuecours2 ";
      $stmt = $db->prepare($req);
      if ($stmt->execute()) {
        $result = $stmt->fetchALL();
        foreach ($result as $row) {
          $course = new cours($row['idcours'], $row['titre'], $row['description'], $row['path_image'],$row['statusCours']);
          $prof = new Enseignant($row['nom'], $row['prenom'], $row['email'], $row['role'], $row['iduser'], $row['password']);
          $course->setProfessor($prof);
          $categorie = new categorie($row['categorie']);
          $course->setCategorie($categorie);
          $courses[] = $course;
        }
        return $courses;
      }
    } catch (PDOException $e) {
      echo "Erreur lors du comptage des cours : " . $e->getMessage();
      return [];
    }
  }

  public static function afficherTousLesCours($page, $parpage)
  {
    $courses = [];
    $premier = ($page * $parpage) - $parpage;

    $db = database::getInstance()->getConnection();
    try {
      $stmt = $db->prepare("SELECT * FROM  vuecours2  where statusCours='accepter' limit :premier , :parpage ");
      $stmt->bindParam(':premier', $premier, PDO::PARAM_INT);
      $stmt->bindParam(':parpage', $parpage, PDO::PARAM_INT);
      if ($stmt->execute()) {
        $result = $stmt->fetchALL();
        foreach ($result as $row) {
          $course = new cours($row['idcours'], $row['titre'], $row['description'], $row['path_image']);
          $prof = new Enseignant($row['nom'], $row['prenom'], $row['email'], $row['role'], $row['iduser'], $row['password']);
          $course->setProfessor($prof);
          $categorie = new categorie($row['categorie']);
          $course->setCategorie($categorie);
          $courses[] = $course;
        }
        return $courses;
      }
      return [];
    } catch (PDOException $e) {
      die("err sql" . $e->getMessage());
    }
  }

  public static function getcoursById($coursId)
  {
    $db = database::getInstance()->getConnection();
    try {
      $stmt = $db->prepare("SELECT * FROM  vuecours2 where idcours=? ");
      $stmt->execute([$coursId]);
      $result = $stmt->fetch();
      if ($result['documentation'] == null) {
        $course = new  coursVedio($result['idcours'], $result['titre'], $result['description'], $result['path_image'], $result['path_vedio']);
        $prof = new Enseignant($result['nom'], $result['prenom'], $result['email'], $result['role'], $result['iduser'], $result['password']);
        $course->setProfessor($prof);
        $categorie = new categorie($result['categorie']);
        $course->setCategorie($categorie);
        return $course;
      } elseif ($result['path_vedio'] == null) {
        $course = new coursDocument($result['idcours'], $result['titre'], $result['description'], $result['path_image'], $result['documentation']);
        $prof = new Enseignant($result['nom'], $result['prenom'], $result['email'], $result['role'], $result['iduser'], $result['password']);
        $course->setProfessor($prof);
        $categorie = new categorie($result['categorie']);
        $course->setCategorie($categorie);
        return $course;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      die("err sql" . $e->getMessage());
    }
  }

  public function setStatus($status){
    $this->status=$status;
  }

  public function accepterCours(){
    $db = database::getInstance()->getConnection();
    try {
        $stmt = $db->prepare("UPDATE cours SET status = 'accepter' WHERE idcours = ?");
        $stmt->execute([$this->idcours]);
        $this->setStatus('accepter');
    } catch (PDOException $th) {
       
        error_log("SQL Error: " . $th->getMessage());
       
        return "An error occurred while updating the course status.";
    }
}

public function refuserCours(){
  $db = database::getInstance()->getConnection();
  try {
      $stmt = $db->prepare("UPDATE cours SET status = 'refuser' WHERE idcours = ?");
      $stmt->execute([$this->idcours]);
      $this->setStatus('refuser');
  } catch (PDOException $th) {
     
      error_log("SQL Error: " . $th->getMessage());
     
      return "An error occurred while updating the course status.";
  }
}

public function deletecours(){
  $db=database::getInstance()->getConnection();
  try {
    $stmt=$db->prepare("DELETE from cours where idcours=?");
    $stmt->execute([$this->idcours]);
  } catch (\Throwable $th) {
    //throw $th;
  }
}

public function updatecours($newtitre,$newdescription){
  $db=database::getInstance()->getConnection();
  try{
      $stmt=$db->prepare("UPDATE cours set titre=? , description=? where idcours=?");
      $stmt->execute([$newtitre,$newdescription,$this->idcours]);
  }catch(PDOException $e){
    die("err sql". $e->getMessage());
  }
}

public static function totalCous($idprof) {
  $total = 0;
  $db = database::getInstance()->getConnection();

  try {
      // Préparer la requête
      $stmt = $db->prepare("SELECT COUNT(*) AS total FROM cours WHERE  idEnseignant = ?");
      
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

public static function allcours(){
  $total = 0;
  $db = database::getInstance()->getConnection();

  try {
      // Préparer la requête
      $stmt = $db->prepare("SELECT COUNT(*) AS total FROM cours ");
      
      // Exécuter la requête
      $stmt->execute([]);
      
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

public  static function cousPlusPopoluare(){
  $db = database::getInstance()->getConnection();

  try {
      // Préparer la requête
      $stmt = $db->prepare("SELECT 
    c.idcours, 
    c.titre, 
    COUNT(i.idEtudiant) AS total_etudiants
FROM 
    cours c
LEFT JOIN 
    inscrire i ON c.idcours = i.idcours
GROUP BY 
    c.idcours
ORDER BY 
    total_etudiants DESC
LIMIT 1;
 ");
      
      // Exécuter la requête
      $stmt->execute([]);
      
      // Récupérer le résultat
      $result = $stmt->fetch();
      if ($result) {
          return $result; // Récupérer la valeur de la colonne 'total'
      }
      
  } catch (PDOException $e) {
      // Afficher ou enregistrer l'erreur
      error_log("Erreur lors de la récupération du total des cours vidéo : " . $e->getMessage());
  }
}


public function gettagCour(){
  $tags=[];
  $db=database::getInstance()->getConnection();
  try{
 $req="SELECT t.* 
        from tag t
        inner join tag_cours t_c
        on t.idtag=t_c.idtag
        where t_c.idcours=?";
  $stmt=$db->prepare($req);
   if($stmt->execute([$this->idcours])){
      $results=$stmt->fetchAll();
      foreach($results as $result){
         $tag=new tag($result['tag'],$result['idtag']);
         $tags[]=$tag;
      }
      return $tags;
   }
   return [];
  }catch(PDOException $e){
    die($e->getMessage());
  }
}

}
