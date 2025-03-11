<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles/output.css">
</head>

<body>
    <?php
    // todo: i want function include($component, $data) 
    ?>
    <header class="p-5 mb-3 border-b border-gray-300">
        <nav class="flex flex-row justify-between font-medium items-center">
            <a href="/">
                <h1>Blog</h1>
            </a>
            <a href="#">
                <button class="bg-blue-700 py-2 px-3 rounded text-white">Войдите в аккаунт</button>
            </a>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer class="border-t border-gray-200">
        <div class="container mx-auto p-5">
            <p class="text-center text-gray-400">
                ©
                <?php echo date('Y'); ?>
                Blog App
            </p>
        </div>
    </footer>

</body>

</html>