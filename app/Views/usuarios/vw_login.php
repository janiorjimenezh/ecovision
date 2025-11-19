  <?php 
      $vbaseurl=base_url();

  ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio de Sesión</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100" style="background-image:url(../img/principal_fondo3.jpg);background-repeat: no-repeat;background-size: cover;">

  <div class="card card-outline card-primary shadow-sm px-1 " style="max-width: 350px; width: 100%;">
    <div class="card-body">
      <div class="col-12 text-center">
          <img src="../img/logo-d.png" alt="" class="img-fluid">
          <br><br>
      </div>
      <form>
        <div class="mb-3">
          <input type="text" class="form-control" id="txtusuario" placeholder="Usuario" required>
        </div>
        <div class="mb-3">
          
          <input type="password" class="form-control" id="txtclave" placeholder="Contraseña" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label" for="remember">Recordarme</label>
          </div>
          <!-- <a href="#" class="small text-decoration-none">¿Olvidaste tu contraseña?</a> -->
        </div>
        <button type="button" class="btn btn-primary w-100" id="btningresar">Ingresar</button>
      </form>
      <p class="text-center mt-3 mb-0">
        ¿No tienes cuenta? <a href="#">Regístrate</a>
      </p>
    </div>
  </div>

  <!-- Bootstrap JS -->
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>

var base_url = '<?php echo $vbaseurl; ?>';
$("#btningresar").click(function(event) {

  vusuario=$("#txtusuario").val();
  vclave=$("#txtclave").val();

  $.ajax({
    url: base_url + "usuario/acceder",
    type: 'post',
    dataType: 'json',
    data: {
            usuario:vusuario,
            clave:vclave
    },
    success: function(e) {
        if (e.msg == "Accediste") {
            window.location=base_url;
        }
        else{
          alert("Usuario y/o clave incorrecta");
        }
    },
    error: function(jqXHR, exception) {
      
    }
  });
  return false;
});
</script>

