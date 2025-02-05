<?php

class CategorieController
{
  function getCategorie()
  {
      $categories = categorie::affichecategorie();
      return $categories;
  }
}