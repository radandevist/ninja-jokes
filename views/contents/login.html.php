<div id="my-login">
    <div class="w-50 my-0 mx-auto">
        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php include_once __DIR__."/demo-credentials.html.php" ?>

        <form method="post" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username">
            </div>

            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email">
                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <button type="submit" name="login" class="btn btn-primary float-right">Login</button>
        </form>
    </div>
</div>