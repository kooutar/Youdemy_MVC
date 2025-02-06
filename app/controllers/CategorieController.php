<?php

class CategorieController
{
  function getCategorie()
  {
      $categories = categorie::affichecategorie();
      return $categories;


  }
  function render()
  {
      require_once __DIR__.'/../views/mesCours.php';
  }

}