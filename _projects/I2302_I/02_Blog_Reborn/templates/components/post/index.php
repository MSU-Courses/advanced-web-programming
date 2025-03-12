<div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1">
    <h2 class="font-medium text-2xl"><?php echo $post['title']; ?></h2>
    <p class="line-clamp-3"><?php echo $post['content']; ?></p>
    <i class="text-gray-400"><?php echo $post['date']; ?></i>
    <a href="/article.php?id=<?php echo $id; ?>">
        <button class="bg-blue-700 py-2 px-3 rounded text-white cursor-pointer">Read More ...</button>
    </a>
</div>