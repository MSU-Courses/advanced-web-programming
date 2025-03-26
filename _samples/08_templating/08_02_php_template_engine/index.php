<?php

require_once 'TemplateEngine.php';

$templater = new TemplateEngine('templates');

echo $templater->render('home.php', ['name' => 'John Doe']);
