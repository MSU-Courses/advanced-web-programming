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

<article class="container mx-auto mt-6">
    <div class="flex flex-col gap-4 px-8">
        <div id="categories" class="flex gap-2">
            <?php
            sort($post['categories']);
            foreach ($post['categories'] as $category): ?>
                <span class="bg-gray-200 text-gray-600 px-2 py-1 rounded-md text-sm"><?php echo $category; ?></span>
            <?php endforeach; ?>
        </div>
        <h1 class="font-mono text-4xl font-bold"><?php echo $post['title']; ?></h1>
        <p><?php echo $post['content']; ?></p>
        <i class="text-gray-500"><?php echo $post['date']; ?></i>
        <a href="/">
            <button class="bg-blue-700 rounded-md px-3 py-2 text-white cursor-pointer">Back to Posts</button>
        </a>
    </div>
</article>


<?php require_once './components/footer.php';
