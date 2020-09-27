<?php if(!is_bool($joke) && ($joke === null || $userId === $joke['authorid'])): ?>
    <div id="add">
        <form class="w-75 my-0 mx-auto" action="" method="post">
            <div class="form-group">
                <label for="jojeText">Your joke</label>
                <textarea id="jokeText" class="d-block w-100 form-control" name="joke[joketext]" rows="5"><?php echo isset($joke) ? $joke['joketext'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="joke[id]" value="<?php echo isset($joke) ? $joke['id'] : '' ?>">
            </div>
            <button class="btn btn-secondary btn-info ml-auto float-right" type="submit" name="submit">Submit</button>
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-danger">You may only edit your own jokes.</div>
<?php endif; ?>