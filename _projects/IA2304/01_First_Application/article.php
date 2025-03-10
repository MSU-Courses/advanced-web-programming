<?php

define('PROJECT_NAME', 'msu-blog');

require_once './data/posts.php';

$id = intval($_GET['id']) - 1;

$post = $posts[$id] ?? null;

if (!$post) {
    header('HTTP/1.1 404 Not Found');
    exit;
}

require_once './components/header.php';

?>

<article class="container mx-auto flex flex-col gap-8 mt-8">
    <div>
        <?php foreach ($post['categories'] as $category) : ?>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"><?php echo $category; ?></span>
        <?php endforeach; ?>
    </div>
    <h1 class="font-bold text-4xl font-mono"><?php echo $post['title']; ?></h1>
    <p class="text-lg"><?php echo $post['content']; ?></p>
    <i class="text-gray-400"><?php echo $post['date']; ?></i>
    <a class="text-blue-700 
        transition duration-300 ease-in-out
        transform hover:translate-x-1 hover:text-blue-900
    " href="/">← Back to posts</a>
</article>

<?php

require_once './components/footer.php';
