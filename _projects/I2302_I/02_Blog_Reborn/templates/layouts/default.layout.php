<?php $title = 'Blog'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/assets/styles/output.css">
</head>

<body>
    <?php $this->renderComponent('header', compact('title')); ?>

    <main>
        <?php echo $content; ?>
    </main>


    <?php $this->renderComponent('footer', compact('title')); ?>
</body>

</html>