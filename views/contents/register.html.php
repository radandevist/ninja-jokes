<?php $form = new HTML\BootstrapForm; ?>

<div id="register">
    <div class="w-50 my-0 mx-auto">
        <?php if (isset($errors)): ?>
            <div class="warnings">
                <div class="alert alert-warning" role="alert">
                    <?php foreach ($errors as $error): ?>
                            <span><?= $error ?></span><?= ($error === end($errors)) ? '.' : ', '?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;?>

        <?php include_once __DIR__."/demo-credentials.html.php" ?>

        <form action="" method="post">
            
            <?= $form->input('text', 'name', 'author[name]', 'your name', $author['name'] ?? ''); ?>
            <?= $form->input('text', 'email', 'author[email]', 'your email address', $author['email'] ?? ''); ?>
            <?= $form->input('password', 'password', 'author[password]', 'Password', $author['password'] ?? ''); ?>
        
            <input class="btn btn-info float-right" type="submit" name="submit" value="Register account">
        
        </form>
    </div>
</div>