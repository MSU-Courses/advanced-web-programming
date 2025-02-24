<?php

define('PROJECT', 'Blog');

require_once './data/posts.php';

$id = intval($_GET['id']);

$post = $posts[$id - 1] ?? null;

if (!$post) {
    header('HTTP/1.1 404 Not Found');
    exit;
}

require_once './components/header.php';

?>

<article class="mt-8">
    <div class="flex flex-col container mx-auto gap-8">
        <h1 class="text-5xl font-mono font-bold"><?php echo $post['title']; ?></h1>
        <p><?php echo $post['content']; ?></p>
        <i class="text-gray-400"><?php echo $post['date']; ?></i>
        <a href="/">
            <button class="text-blue-700 cursor-pointer
                transaction duration-300 ease-in-out 
                hover:translate-x-2 hover:text-blue-900
            ">← Back to home</button>
        </a>
    </div>
</article>

<?php require_once './components/footer.php';
