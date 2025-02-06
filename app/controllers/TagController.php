<?php
 require_once __DIR__.'/../config/autoloadclasse.php';
class TagController
{

//    function fetchTags()
//    {
////        header("Content-Type: application/json");
////        $tags=tag::afficheTag();
////        $tagNames = array_map(function($tag) {
////            return $tag->getTag();
////        }, $tags);
////
////        echo json_encode($tagNames);
//
//}
    public function fetchTags()
    {
        $tags = tag::afficheTag();
        return $tags;

//        header("Content-Type: application/json");
//        echo json_encode($tags);
    }
}