<?php

define("PROJECT", "blog");

require_once './data/posts.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($posts[$_GET['id'] - 1])) {
    header('HTTP/1.1 404 Not Found');
    exit;
}

$post = $posts[$_GET['id'] - 1];


require_once './components/header.php';
?>

<article>
    <h1 class="text-2xl"><?php echo $post['title']; ?></h1>
</article>

<?php

require_once './components/footer.php';
