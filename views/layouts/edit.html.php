<div id="add">
    <form action="" method="post">
        <textarea name="joke[joketext]" rows="5"><?php echo isset($joke) ? $joke['joketext'] : '' ?></textarea>
        <input type="hidden" name="joke[id]" value="<?php echo isset($joke) ? $joke['id'] : '' ?>">
        <div class="submiter">
            <button type="submit" name="submit">submit</button>
        </div>
    </form>
</div>