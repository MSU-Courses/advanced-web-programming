<div id="app" class="container mx-auto">
    <section id="posts" class="py-8">
        <h1 class="font-mono text-3xl font-bold pb-8">#_posts</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($posts ?? [] as $id => $post) : ?>
                <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1">
                    <h2 class="font-medium text-2xl"><?php echo $post['title']; ?></h2>
                    <p class="line-clamp-2"><?php echo $post['content']; ?></p>
                    <i class="text-gray-400"><?php echo $post['date']; ?></i>
                    <a href="/article.php?id=<?php echo $id + 1; ?>">
                        <button class="bg-blue-700 hover:bg-blue-600 px-3 py-2 text-white cursor-pointer rounded-md">Read More ... </button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>