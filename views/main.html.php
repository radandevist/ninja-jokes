<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/styles/main.css">
    <?php if(isset($stylesheet)): ?>
        <link rel="stylesheet" href="<?php echo $stylesheet ?>">
    <?php endif ?>
</head>
<body>
    <header>
        <div>
            <h2>The internet joke database</h2>
        </div>
        <?php include_once __DIR__.'/./nav.html.php'; ?>
    </header>
    <main>
        <?php echo $content ?>
    </main>
    <footer>
        <div>
        <p>&copy;<?php echo date('Y'); ?> IJDB</p>
        </div>
    </footer>
</body>
</html>