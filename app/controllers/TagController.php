<?php
 require_once __DIR__.'/../config/autoloadclasse.php';
class TagController
{


    public function fetchTags()
    {
        $tags = tag::afficheTag();
        return $tags;
    }
}