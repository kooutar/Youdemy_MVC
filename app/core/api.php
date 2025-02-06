<?php
require_once __DIR__.'/../controllers/TagController.php';

header("Content-Type: application/json");

$TagController = new TagController();
$tags = $TagController->fetchTags();
$tagNames = array_map(function ($tag) {
    return $tag->getTag();
}, $tags);
echo json_encode($tagNames);
