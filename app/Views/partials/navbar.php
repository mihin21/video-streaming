<?php

use Fluent\Auth\Facades\Auth;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid mx-2">
    <a class="navbar-brand" href="#">Video streaming</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mes videos</a>
        </li>
      </ul>
      <div class="d-flex">
            <div class="p-2 fw-bold ">
              <a class="text-decoration-none" href="<?= route_to('profile') ?>"><?= Auth::user()->username ?></a>
            </div>
            <form action='<?= route_to('logout')?>' method='post'>
                <button type="submit" class='text-white text-decoration-none fw-bold btn btn-info'>Deconnexion</button>
            </form>
      </div>
    </div>
  </div>
</nav>