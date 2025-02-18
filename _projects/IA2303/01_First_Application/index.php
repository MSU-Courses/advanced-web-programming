<?php
define('PROJECT', 'Blog');

require_once './data/posts.php';

require_once './components/header.php';
?>

<div id="app" class="container mx-auto py-8">
    <section id="posts">
        <h1 class="font-mono text-3xl font-bold pb-3">#_posts</h1>
        <div class="flex justify-between gap-3">
            <?php foreach ($posts as $post) : ?>
                <div class="border border-gray-200 p-4 my-4 basis-1/3 rounded flex flex-col gap-4">
                    <h2 class="font-medium text-2xl"><?php echo $post['title']; ?></h2>
                    <p><?php echo $post['content']; ?></p>
                    <i class="text-gray-400"><?php echo $post['date']; ?></i>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php require_once './components/footer.php'; ?>