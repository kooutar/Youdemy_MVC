<?php
require_once 'db.php';
class inscrire{
    private $idcours;
    private $idEtudiant;
    public function __construct($idcours,$idEtudiant)
    {
       $this->idcours=$idcours;
       $this->idEtudiant=$idEtudiant;
    } 
   public function inscrire(){
    $db = database::getInstance()->getConnection();
    try {
       $stmt=$db->prepare("INSERT into inscrire values(?,?) ");
       $stmt->execute([$this->idEtudiant,$this->idcours]);
    } catch (PDOException $th) {
        echo "Erreur PDO : " . $th->getMessage(); 
    return false; 
    }
   } 
   
   public  function verifierEtusiantInscrireCours() : bool{
    $db = database::getInstance()->getConnection();
    try {
       $stmt=$db->prepare("SELECT  * from inscrire where idEtudiant=? and  idcours=? ");
       $stmt->execute([$this->idEtudiant,$this->idcours]);
       $count=$stmt->fetchColumn();
       return $count>0;
    } catch (PDOException $th) {
        echo "Erreur PDO : " . $th->getMessage(); 
    return false; 
    }
   }
}