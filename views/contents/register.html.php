<?php
    use HTML\BootstrapForm;
    // $form = new Form;
    $form = new BootstrapForm;
?>
<div id="register">
    <form class="w-50 my-0 mx-auto" action="" method="post">
        
        <?= $form->input('text', 'email', 'author[email]', 'your email address'); ?>
        <?= $form->input('text', 'name', 'author[name]', 'your name'); ?>
        <?= $form->input('password', 'password', 'author[password]', 'Password'); ?>
    
        <input class="btn btn-info float-right" type="submit" name="submit" value="Register account">
    
    </form>
</div>