<?php

define('APP_NAME', 'Blog');

require_once './data/posts.php';

require_once './handlers/post-handler.php';

require_once './functions/template.php';

require_once './components/header.php';

?>

<main class="container mx-auto py-6 px-8">
    <form class="flex flex-col gap-3" method="POST" action="/article-create.php">
        <div>
            <label for="title" class="block font-bold text-xl">Title</label>
            <input type="text" id="title" name="title" class="border border-gray-300 rounded-md p-2 w-full mt-2"
                value="<?php echo $_POST['title'] ?? ''; ?>">
            <?php renderErrorIfExist($errors, 'title') ?>
        </div>
        <div class="mt-4">
            <label for="content" class="block font-bold text-xl">Content</label>
            <textarea id="content" name="content" class="border border-gray-300 rounded-md p-2 w-full h-32 mt-2"><?php echo $_POST['content'] ?? ''; ?>
            </textarea>
            <?php renderErrorIfExist($errors, 'content') ?>
        </div>
        <div class="mt-4">
            <label for="categories" class="block font-bold text-xl">Categories</label>
            <input type="text" id="categories" name="categories" class="border border-gray-300 rounded-md p-2 w-full mt-2"
            value="<?php echo $_POST['categories'] ?? ''; ?>">
            <i class="text-gray-500 text-sm">* Separate categories with commas (,)</i>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-700 rounded-md px-3 py-2 text-white cursor-pointer">Create Article</button>
        </div>
    </form>
</main>

<?php require_once './components/footer.php';
