<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/vendors/bootstrap-4.5/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/main.css">

</head>
<body class="d-flex flex-column">

    <header>
        <?php include_once __DIR__.'/./nav.html.php'; ?>
    </header>
    
    <main>
        <div class="container">
            <?php //var_dump($_SESSION); ?>

            <?php echo $content ?>
        </div>
    </main>

    <footer class="bg-dark mt-3 py-1 pt-2 text-white">
        <div class="container mt-3">
        <p>copyright &copy;<?php echo date('Y'); ?> IJDB</p>
        </div>
    </footer>

    <script type='text/javascript' src="/vendors/jquery-3.4.1.js"></script>
    <script type='text/javascript' src="/vendors/bootstrap-4.5/js/bootstrap.js"></script>
</body>
</html>