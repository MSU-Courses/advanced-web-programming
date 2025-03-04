<?php

define('PROJECT', 'Blog');

require_once './data/posts.php';

require_once './functions/template.functions.php';

require_once './handlers/post.handler.php';

require_once './components/header.php';

?>


<main>
    <form class="container mx-auto mt-8 space-y-4" method="post" action="/article-create.php">
        <div class="flex flex-col">
            <label for="title" class="mb-2 text-lg font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="<?php echo $_POST['title'] ?? ''; ?>" />
            <?php printFormError($errors, 'title'); ?>
        </div>
        <div class="flex flex-col">
            <label for="content" class="mb-2 text-lg font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo $_POST['content'] ?? ''; ?></textarea>
            <?php printFormError($errors, 'content'); ?>
        </div>
        <div class="flex flex-col">
            <label for="categories" class="mb-2 text-lg font-medium text-gray-700">Categories</label>
            <select id="categories" name="categories[]" multiple required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Technology">Technology</option>
                <option value="Science">Science</option>
                <option value="Art">Art</option>
                <option value="Music">Music</option>
            </select>
            <?php printFormError($errors, 'categories'); ?>
        </div>
        <button type="submit" class="bg-blue-700 hover:bg-blue-600 px-3 py-2 text-white cursor-pointer rounded-md">Create</button>
    </form>
</main>

<?php require_once './components/footer.php';
