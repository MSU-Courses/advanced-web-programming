<?php

define('PROJECT_NAME', 'msu-blog');

require_once './data/posts.php';

require_once './functions/template.php';

require_once './handlers/post-handler.php';

require_once './components/header.php';

?>

<main>
    <form class="max-w-lg mx-auto p-4 bg-white shadow-md rounded mt-5" method="post" action="/article-create.php">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $_POST['title'] ?? ''; ?>">
            <?php echo getError($errors, 'title'); ?>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
            <textarea id="content" name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $_POST['content'] ?? ''; ?></textarea>
            <?php echo getError($errors, 'content'); ?>
        </div>
        <div class="mb-4">
            <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Categories</label>
            <select id="categories" name="categories[]" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="celebration">celebration</option>
                <option value="news">news</option>
                <option value="sports">sports</option>
                <option value="technology">technology</option>
            </select>
            <?php echo getError($errors, 'categories'); ?>
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer">Create</button>
        </div>
    </form>
</main>

<?php require_once './components/footer.php';
