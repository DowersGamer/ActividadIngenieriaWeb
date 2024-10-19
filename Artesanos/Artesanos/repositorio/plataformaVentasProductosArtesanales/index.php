<?php
  session_start(); 
?>
<style>
  .tabLogin{
    display: flex;
    border: 2px solid rgb(2 171 207 / 92%);
    background-color: rgb(151 211 253 / 18%);
    font-weight: bold;
    border-radius: 13px;
    align-items: center;
    transition: 2s ease;
  }
  .tabLogin:hover{
    transform: scale(.94);
  }

</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>CoopArtesanos</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">CoopArtesanos</a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo03">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item mx-2">
            <a class="nav-link active" aria-current="page" href="#">Manillas</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="#">Ollas</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="#">Atrapa sueños</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Nosotros
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Mision</a></li>
              <li><a class="dropdown-item" href="#">Que es CoopArtesanos</a></li>
              <li><a class="dropdown-item" href="#">Ventajas de nuestro modelo</a></li>
            </ul>
          </li>
          <li class="nav-item tabLogin px-2">
            <a class="nav-link p-0" href="#">Iniciar sesion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>