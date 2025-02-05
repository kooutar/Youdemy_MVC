<?php
require_once __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../config/autoloadclasse.php';
class CoursController
{

      function getVedioCours($prof)
      {
          $cours=new coursVedio(null,null,null,null,null);
          $cours->setProfessor($prof);
         return  $prof->consulterMesCours($cours);

           // ****************
//          $cours=new coursDocument(null,null,null,null,null);
//          $cours->setProfessor($prof);
//          $coursDocument= $prof->consulterMesCours($cours);
      }

    function getDocumentCours($prof)
    {
          $cours=new coursDocument(null,null,null,null,null);
          $cours->setProfessor($prof);
          return $prof->consulterMesCours($cours);
    }
}