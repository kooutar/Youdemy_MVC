<?php
require_once __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../config/autoloadclasse.php';

class CoursController
{
    private Enseignant $prof;
    public function __construct()
    {
        Session::ActiverSession();
        $this->prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
    }

    function getVedioCours()
      {
          $cours=new coursVedio(null,null,null,null,null);
          $cours->setProfessor($this->prof);
          return  $this->prof->consulterMesCours($cours);
      }

    function getDocumentCours()
    {
          $cours=new coursDocument(null,null,null,null,null);
          $cours->setProfessor($this->prof);
          return $this->prof->consulterMesCours($cours);
    }

    function ajoutCours()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            session::ActiverSession();
            $prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
//            $tags=$_POST['tags'];
//            $tagsArray=json_decode($tags,true);
//            $tags = array_column($tagsArray, 'value');
//            $tagString= implode(", ", $tags);
//            $arraytag=explode(',',$tagString);
            $image= cours::validateImage($_FILES['image']['name'],$_FILES['image']['tmp_name']);
            if($_POST['typeCours']=='vedio'){
                $urlvedio=coursVedio::validatepathVedio($_FILES["url"]["name"],$_FILES["url"]["tmp_name"]);
                $cours=new coursVedio(null,$_POST['titre'],$_POST['description'],$image,$urlvedio);
                $categorie=new categorie($_POST['categorie']);
                $cours->setCategorie($categorie);
                $finalCours= $prof->ajouterCours($cours);
//                foreach ($arraytag as $tag) {
//                    $existingTag = tag::tagNameExist($tag);
//                    if (!empty($existingTag)) {
//                        tag_cours::insert_tag_cours($finalCours->idcours, $existingTag);
//                    }
//                }

                Session::ActiverSession();
                $_SESSION['success'] = "ajout cours  avec success !";
                header('location: ../front/mesCours.php');
                exit();
            }if($_POST['typeCours']=='document'){
                $document=coursDocument::validateDocument($_FILES['document']['name'],$_FILES['document']['tmp_name']);
                $cours= new coursDocument(null,$_POST['titre'],$_POST['description'],$image,$document);
                $categorie=new categorie($_POST['categorie']);
                $cours->setCategorie($categorie);
                $finalCours=$prof->ajouterCours($cours);
//                foreach ($arraytag as $tag) {
//                    echo $tag."<br>";
//                    $existingTag = tag::tagNameExist($tag);
//                    var_dump($existingTag);
//                    if (!empty($existingTag)) {
//                        tag_cours::insert_tag_cours($finalCours->idcours, $existingTag);
//                    }
//                }
                Session::ActiverSession();
                $_SESSION['success'] = "ajout cours  avec success !";
                header('location: ../front/mesCours.php');
                exit();

            }
        }
    }
}