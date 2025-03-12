<main class="container mx-auto flex flex-col gap-4">
    <section id="posts" class="py-8">
        <h1 class="font-mono text-3xl font-bold pb-8">#_posts</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($posts as $id => $post) : ?>
                <?php $this->renderComponent('post/index', compact('id', 'post')); ?>
            <?php endforeach; ?>
            <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1 items-center justify-center">
                <a href="/article/create">
                    <button class="rounded-full flex items-center justify-center border border-gray-200 px-8 py-6
                        transition duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg cursor-pointer">
                        +
                    </button>
                </a>
            </div>
        </div>
    </section>
</main>