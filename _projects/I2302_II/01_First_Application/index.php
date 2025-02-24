<?php

define('APP_NAME', 'Blog');

require_once './data/posts.php';

require_once './components/header.php';

?>

<main>
    <section id="posts" class="container mx-auto py-6 px-8">
        <h1 class="font-bold text-2xl font-mono">#_posts</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($posts as $i => $post) : ?>
                <div class="border border-gray-300 rounded-md p-4 mt-4 flex flex-col gap-3 col-span-1">
                    <h2 class="font-bold text-xl"><?php echo $post['title']; ?></h2>
                    <p class="text-gray-600 line-clamp-3"><?php echo $post['content']; ?></p>
                    <i class="text-gray-500"><?php echo $post['date']; ?></i>
                    <a href="/article.php?id=<?php echo $i + 1; ?>">
                        <button class="bg-blue-700 rounded-md px-3 py-2 text-white cursor-pointer">Read More ...</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once './components/footer.php';
