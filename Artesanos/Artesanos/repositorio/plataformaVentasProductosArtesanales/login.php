<?php
session_start();
include './dbConnection.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  if (isset($_POST['correoUsu']) && isset($_POST['contrasenaUsu'])) {
    $email = $conn->real_escape_string($_POST['correoUsu']);
    $contrasena = $conn->real_escape_string($_POST['contrasenaUsu']);
    $sql = "SELECT * FROM usuarios WHERE correo_electronico = '$email'";
    $resultado = $conn->query($sql);
    if($resultado->num_rows > 0){
      $resultado = $resultado->fetch_object();
      if (password_verify($contrasena, $resultado->contrasena ?? '')) {
        $_SESSION['logueado'] = true;
        header('Location: index.php');
        exit;
      }else{
        $_SESSION["registerFailded"] = "Contraseña incorrecta";
      }
     
    }else{
      $_SESSION["registerFailded"] = "El correo ingresado, no esta asociado a ningun usuario";
    }  
  }else{
    $_SESSION["registerFailded"] = "Todos los campos son obligatorios";
  }
}elseif (isset($_SESSION["logueado"])) {
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="login.css">
  <title>Login</title>
</head>
<body>
  <main>
    <div class="container-fluid contenedorPrincipal">
      <div class="row">
        <div class="col-6 contenedorImagen"></div>
        <div class="col-6 contenedorFormulario p-5">
          <h2 class="text-center text-primary fw-bold">Inicio de sesion</h2>
          <div class="card m-5">
            <div class="card-body">
              <form action="login.php" method="POST">
                <label class='ms-1 fw-bold pb-2' for="correoUsu">Correo electronico:</label>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="correoUsu" name="correoUsu" placeholder="nombre@ejemplo.com" required>
                  <label for="floatingInput">Correo electronico</label>
                </div>
                <label class='ms-1 fw-bold pb-2' for="contrasenaUsu">Contraseña:</label>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="contrasenaUsu" name="contrasenaUsu" placeholder="Contraseña" required>
                  <label for="floatingPassword">Contraseña</label>
                </div>
                <button class="btn btn-success container-fluid mt-3">Iniciar sesion</button>
                <p class="mt-2 mb-1 text-center">¿No tiene una cuenta? <a href="./registro.php" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Registrese</a></p>
              </form>
            </div>
          </div>
          <?php
            if (isset($_SESSION["registerFailded"])) {
          ?>
            <div class="alert alert-danger mt-3">
            <?php echo$_SESSION["registerFailded"] ?>
            </div>
          <?php
            unset($_SESSION["registerFailded"]);
            }
          ?>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>