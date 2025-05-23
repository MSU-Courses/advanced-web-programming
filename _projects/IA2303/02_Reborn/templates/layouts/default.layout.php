<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo  '/assets/styles/output.css' ?>">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="border-b border-gray-200 p-4 text-base">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="font-medium">Blog</h1>
                <a href="#">
                    <button class="bg-blue-700 text-white px-3 py-1 rounded-md cursor-pointer">Login</button>
                </a>
            </div>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer class="border-t border-gray-200 p-4 text-center">
        (c) <?php echo date('Y'); ?> Blog
    </footer>
</body>

</html>