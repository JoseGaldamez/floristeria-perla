<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/global.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
  </style>

</head>

<body>

  <?php
  include '../app/includes/menu.php';
  ?>

  <div class="container pt-5">
    <h2 class="text-pink mt-5 pt-5 mb-5">Perfil de usuario</h2>
    <hr>

    <div class="row mt-5">
      <div class="col-2 align-self-center">
        <img src="../assets/imagen/placeholder.png" class="img-thumbnail rounded-circle" alt="Foto de Perfil">
      </div>
      <div class="col-8 align-self-center">
        <h3>Nombre de Usuario</h3>
        <p>El Progreso, Yoro, Honduras</p>
      </div>
    </div>
    <div class="text-end">
      <button type="button" class="btn text-pink" data-bs-toggle="modal" data-bs-target="#updateUser">
        <strong>Editar Información</strong>
      </button>
    </div>
    <div class="profile-card border rounded p-5 mt-5">
      <p><strong>Dirección:</strong> El Progreso, Yoro, Honduras</p>
      <p><strong>Teléfono:</strong> +504 3175 1455</p>
      <p><strong>Sexo:</strong> Masculino</p>
      <p><strong>Fecha de nacimiento:</strong> 15 de septiembre de 1991</p>
    </div>

    <h4 class="text-pink mt-4">Historial de compras</h4>
    <div class="profile-card border rounded p-5 mt-5 text-center mb-5">
      <p>Sin compras por el momento...</p>
    </div>
  </div>


  <div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="userName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="userName" placeholder="Juan Perez" required>
            </div>
            <div class="mb-3">
              <label for="userAddress" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="userAddress" placeholder="El Progreso, Yoro" required>
            </div>
            <div class="mb-3">
              <label for="userPhone" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="userPhone" placeholder="+504 3175 1455" required>
            </div>
            <div class="mb-3">
              <label for="userSex" class="form-label">Sexo</label>
              <select class="form-select" id="userSex" aria-label="Sexo">
                <option selected>Elija su sexo</option>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="userDate" class="form-label">Fecha de nacimiento</label>
              <input id="userDate" class="form-control" type="date" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Actualizar datos</button>
        </div>
      </div>
    </div>
  </div>

  <?php
  include '../app/includes/footer.php';
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>