<?php

define('PROJECT_NAME', 'msu-blog');

require_once './data/posts.php';

require_once './components/header.php';

?>

<main class="container mx-auto">
    <h1 class="my-6 font-bold text-4xl font-mono">Posts</h1>
    <div class="flex flex-row flex-wrap justify-between">
        <?php foreach($posts as $post) : ?>
            <div class="flex flex-col gap-4 border border-gray-300 basis-md p-3 rounded-md">
                <h1 class="text-xl font-medium"><?php echo $post['title']; ?></h1>
                <p><?php echo $post['content']; ?></p>
                <i class="text-gray-400"><?php echo $post['date']->format('Y-m-d'); ?></i>
                <a class="text-blue-700" href="#">Read more ...</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once './components/footer.php'; ?>