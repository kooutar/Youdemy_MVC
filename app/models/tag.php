<?php
// require_once '../autoload.php';
require_once __DIR__.'/../config/db.php';
require_once 'session.php';

class tag implements JsonSerializable{
    private $id;
    private $tag;

    function __construct($tag,$id=null)
    {
        $this->tag=$tag;
        $this->id=$id;
    }

    public function jsonSerialize() :array{
      return [
          'id' => $this->id,
          'tag' => $this->tag
      ];
  }

  public function getTag(){return $this->tag;}
  public function getId(){return $this->id;     }

    public static function insertTag($tag){
          $db=database::getInstance()->getConnection();
          try {
            $stmt=$db->prepare("INSERT INTO  tag(tag) VALUES(?)");
             $stmt->execute([$tag]);
            $lastinsertId=$db->lastInsertId();
            $tag= new tag($tag,$lastinsertId);
            return $tag;

          } catch (PDOException $e){
            $e->getMessage();
           
          }
    }
  
    public static function afficheTag(){
      $tags=[];
      $db=database::getInstance()->getConnection();
      try{
        $stmt=$db->prepare("SELECT * FROM tag");
        if($stmt->execute()){
         $result= $stmt->fetchAll();
         foreach($result as $row){
          $tags[] = new tag($row['tag'], $row['idtag']);
         }
        }
        return $tags;
      } catch(PDOException $e){
        $e->getMessage();
      } 
    }

    static function  tagNameExist($tagName) {
      $db=database::getInstance()->getConnection();
      try {
        $stmt = $db->prepare("SELECT idtag FROM tag WHERE tag = :tagname");
        $stmt->execute(['tagname' => $tagName]);
        $result = $stmt->fetch(); 
        if ($result) {
          return $result['idtag']; 
      } else {
          return []; 
      }
      } catch (\PDOException $th) {
        die("errr sql".$th->getMessage());
      }

  }
   public function update($newtag){

    $db=database::getInstance()->getConnection();
    try {
        $stmt=$db->prepare("UPDATE tag SET tag=? where idtag=? ");
         $stmt->execute([$newtag,$this->id]);
    } catch (\PDOException $th) {
      die('ERR SQL'.$th->getMessage());
    }

   }



}

