<?php

define("PROJECT", "blog");

require_once './data/posts.php';

$id = $_GET['id'] ?? null;

$post = $posts[$id] ?? null;

if (!$post) {
    header('HTTP/1.1 404 Not Found');
    exit;
}

require_once './components/header.php';
?>

<article class="container mx-auto p-8">
    <div class="flex flex-col gap-8">
        <h1 class="text-5xl font-mono font-semibold"><?php echo $post['title']; ?></h1>
        <div>
            <?php foreach ($post['categories'] as $category) : ?>
                <span class="bg-gray-200 px-2 py-1 rounded"><?php echo $category; ?></span>
            <?php endforeach; ?>
        </div>
        <p class="leading-8"><?php echo $post['content']; ?></p>
        <i class="text-gray-500"><?php echo $post['date']; ?></i>
        <a href="/" class="text-blue-800 
            transition duration-300 ease-in-out hover:translate-x-1 hover:text-blue-600 hover:font-semibold
        ">← Back to posts</a>
    </div>
</article>

<?php

require_once './components/footer.php';
