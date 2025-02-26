<?php

define("PROJECT", "blog");

require_once './data/posts.php';

require_once './functions/template.php';

require_once './handlers/post.handler.php';

require_once './components/header.php';

?>


<main class="container mx-auto p-8">
    <form class="space-y-6" method="post">
        <div class="flex flex-col gap-2">
            <label for="title" class="text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="<?php echo $_POST["title"] ?? ""; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <?php printFormErrors($errors, 'title'); ?>
        </div>
        <div class="flex flex-col gap-2">
            <label for="content" class="text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo $_POST["content"] ?? ""; ?></textarea>
            <?php printFormErrors($errors, 'content'); ?>
        </div>
        <div class="flex flex-col gap-2">
            <label for="categories" class="text-sm font-medium text-gray-700">Categories</label>
            <select id="categories" name="categories[]" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="celebration">celebration</option>
                <option value="lifestyle">lifestyle</option>
                <option value="fincance">fincance</option>
            </select>
            <?php printFormErrors($errors, 'categories'); ?>
        </div>
        <div>
            <button type="submit" class="bg-blue-700 py-2 px-3 rounded text-white cursor-pointer hover:bg-blue-800">Create</button>
        </div>

        <!-- <div>
            <input type="email" name="email[from]">
            <input type="email" name="email[to]">
        </div> -->
    </form>
</main>

<?php require_once './components/footer.php';
