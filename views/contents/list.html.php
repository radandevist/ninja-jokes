<div id="list">
   <?php foreach($jokes as $joke): ?>
   <?php //print_r($joke); ?>
   <div class="joke-group">
      <div>
         <blockquote>
            <p><?php echo htmlspecialchars($joke['joketext'], ENT_QUOTES, 'utf-8') ?></p>
         </blockquote>
         <!-- <div> -->
         <form action="/index.php?r=joke/delete" method="post">
            <a href="/index.php?r=joke/edit&id=<?php echo $joke['id'] ?>">edit</a>
            <input type="hidden" name="id" value="<?php echo $joke['id'] ?>">
            <input type="submit" value="Delete">
         </form>
         <!-- </div> -->
      </div>
      <small>
         by <a href="mailto:<?php echo $joke['email'] ?>"><?php echo htmlspecialchars($joke['name'], ENT_QUOTES, 'utf-8') ?></a>
          on   <?php
                  $date = new DateTime($joke['jokedate']);
                  echo $date->format('jS F Y');
               ?></small>
   </div>
   <?php endforeach ?>
</div>