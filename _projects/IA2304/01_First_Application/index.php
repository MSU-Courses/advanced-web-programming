<?php

define('PROJECT_NAME', 'msu-blog');

require_once './data/posts.php';

require_once './components/header.php';

?>

<main class="container mx-auto">
    <h1 class="my-6 font-bold text-4xl font-mono">Posts</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($posts as $id => $post) : ?>
            <div class="flex flex-col gap-4 border border-gray-300 basis-md p-3 rounded-md">
                <h1 class="text-xl font-medium"><?php echo $post['title']; ?></h1>
                <p class="line-clamp-2"><?php echo $post['content']; ?></p>
                <i class="text-gray-400"><?php echo $post['date']; ?></i>
                <a class="text-blue-700" href="/article.php?id=<?php echo $id + 1; ?>">Read more ...</a>
            </div>
        <?php endforeach; ?>
        <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1 items-center justify-center">
            <a href="/article-create.php">
                <button class="rounded-full flex items-center justify-center border border-gray-200 px-8 py-6
                        transition duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg cursor-pointer">
                    +
                </button>
            </a>
        </div>
    </div>
</main>

<?php require_once './components/footer.php'; ?>