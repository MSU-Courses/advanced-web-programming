<?php

require_once 'TemplateEngine.php';

$templater = new TemplateEngine('templates');

echo $templater->render('home.tpl', ['name' => 'John Doe']);
