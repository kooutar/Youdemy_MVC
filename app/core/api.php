<?php
require_once __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../config/autoloadclasse.php';

header("Content-Type: application/json");

$TagController = new TagController();
$tags = $TagController->fetchTags();
$tagNames = array_map(function ($tag) {
    return $tag->getTag();
}, $tags);
echo json_encode($tagNames);
