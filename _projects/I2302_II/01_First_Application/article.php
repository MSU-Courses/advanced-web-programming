<?php

define('APP_NAME', 'Blog');

require_once './data/posts.php';

$id = $_GET['id'] ?? null;

$post = $posts[$id - 1] ?? null;

if (!$id || !is_numeric($id) || !$post) {
    header('HTTP/1.0 404 Not Found');
    return;
}

require_once './components/header.php';

?>

<article class="container mx-auto">
    <?php echo $post['title']; ?>
</article>


<?php require_once './components/footer.php';
