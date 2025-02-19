<?php

define('APP_NAME', 'Blog App');

require_once './data/posts.php';

require_once './components/header.php';

?>

<main>
    <section id="posts" class="container mx-auto py-6 px-8">
        <h1 class="font-bold text-2xl">#_posts</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($posts as $post) : ?>
                <div class="border border-gray-300 rounded-md p-4 mt-4 flex flex-col gap-3 col-span-1">
                    <h2 class="font-bold text-xl"><?php echo $post['title']; ?></h2>
                    <p class="text-gray-600"><?php echo $post['content']; ?></p>
                    <i class="text-gray-500"><?php echo $post['date']; ?></i>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once './components/footer.php';
