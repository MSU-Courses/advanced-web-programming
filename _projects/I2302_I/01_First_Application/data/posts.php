<?php

$postsPath = __DIR__ . '/posts.json';

$posts = file_exists($postsPath) ?
    json_decode(file_get_contents($postsPath), true) :
    [];
