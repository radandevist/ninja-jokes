<div id="list">
   <h2 class="text-center mb-5">Available jokes</h2>
   <?php foreach($jokes as $joke): ?>
   <?php //print_r($joke); ?>
   <div class="joke-group mb-4">
      <!-- <div> -->
         <blockquote class="px-2 py-2 rounded mb-0">
            <p class="mb-0"><?php echo htmlspecialchars($joke['joketext'], ENT_QUOTES, 'utf-8') ?></p>
         </blockquote>
         <div class="d-flex justify-content-between">
            <small class="mt-2 ml-2 text-muted">
               by <a href="mailto:<?php echo $joke['email'] ?>"><?php echo htmlspecialchars($joke['name'], ENT_QUOTES, 'utf-8') ?></a>
               on   <?php
                        $date = new DateTime($joke['jokedate']);
                        echo $date->format('jS F Y');
                     ?>
            </small>
            <form class="d-flex justify-content-end" action="/joke/delete" method="post">
               <?php if($userId === $joke['authorId']): ?>
                  <a class="btn btn-link pt-0" href="/joke/edit?id=<?php echo $joke['id'] ?>">edit</a>
                  <button class="btn btn-link border-0 pt-0" type="submit">Delete</button>
               <?php endif; ?>
               <input type="hidden" name="id" value="<?php echo $joke['id'] ?>">
            </form>
         </div>
      <!-- </div> -->
   </div>
   <?php endforeach; ?>
</div>