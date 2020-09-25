<?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

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

    <button type="submit" name="login" class="btn btn-primary">Login</button>
</form>