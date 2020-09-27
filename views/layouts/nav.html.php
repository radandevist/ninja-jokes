<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php if ('' === $route) echo 'active'; ?>">
        <a class="nav-link" href='/'>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php if ('joke/list' === $route) echo 'active' ?>">
        <a class="nav-link" href='/joke/list'>List</a>
      </li>
      <li class="nav-item <?php if ('joke/edit' === $route) echo 'active' ?>">
        <a class="nav-link" href='/joke/edit'>Add</a>
      </li>
      
      <?php if(!$loggedIn): ?>
        <li class="nav-item ml-3">
          <a class="nav-link btn btn-primary text-white" href="/author/register" role="button">Register</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link btn btn-primary btn-success text-white" href="/login" role="button">Login</a>
        </li>
      <?php else: ?>
        <li class="nav-item ml-3">
          <a class="nav-link btn btn-primary btn-success text-white" href="/logout" role="button">Log Out</a>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</nav>