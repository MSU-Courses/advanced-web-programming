<?php

$postPath = __DIR__ . "/posts.json";

$posts = file_exists($postPath) ?
    json_decode(file_get_contents($postPath), true) : [];
