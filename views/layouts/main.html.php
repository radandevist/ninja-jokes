<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:title" content="Ninja Jokes">
    <meta property="og:description" content="A simple crud php app with no frameworks.">
    <meta property="og:image" content="http://ninjajokes.epizy.com/assets/images/social-preview.png">
    <meta property="og:url" content="http://ninjajokes.epizy.com">

    <title><?= $title ?></title>

    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">

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
        <div class="container mt-3 d-flex justify-content-between">
        <p>copyright &copy;<?php echo date('Y'); ?> IJDB</p>
        <div class="small text-muted text-white-50">Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        </div>
    </footer>

    <script type='text/javascript' src="/vendors/jquery-3.4.1.js"></script>
    <script type='text/javascript' src="/vendors/bootstrap-4.5/js/bootstrap.js"></script>
</body>
</html>