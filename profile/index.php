<!DOCTYPE html>
<html lang="en">
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
include_once '../../app/model/register.model.php';
include_once '../../app/conn/conn.php';

// Asignar el ID del usuario
$userID = 1; 

// Obtener datos del usuario
$user = getUserByID($conn, $userID);

// Verificar si se obtuvo el usuario
if ($user) {
    $userName = htmlspecialchars($user["userName"]);
    $userEmail = htmlspecialchars($user["userEmail"]);
    $userAddress = htmlspecialchars($user["userAddress"]);
    $userPhone = htmlspecialchars($user["userPhone"]);
    $userSex = htmlspecialchars($user["userSex"]);
    $userDate = htmlspecialchars($user["userDate"]);
    $userPhoto = htmlspecialchars($user["userPhoto"]);
} else {
    echo "No se encontró el usuario.";
    $userName = $userEmail = $userAddress = $userPhone = $userSex = $userDate = $userPhoto = "No disponible";
}
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

  <div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUserForm" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="userName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="userName" name="userName" placeholder="Juan Perez" required>
            </div>
            <div class="mb-3">
              <label for="userAddress" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="userAddress" name="userAddress" placeholder="El Progreso, Yoro" required>
            </div>
            <div class="mb-3">
              <label for="userPhone" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="userPhone" name="userPhone" placeholder="+504 3175 1455" required>
            </div>
            <div class="mb-3">
              <label for="userSex" class="form-label">Sexo</label>
              <select class="form-select" id="userSex" name="userSex" aria-label="Sexo">
                <option selected>Elija su sexo</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="userDate" class="form-label">Fecha de nacimiento</label>
              <input id="userDate" name="userDate" class="form-control" type="date" />
            </div>
            <div class="mb-3">
              <label for="userPhoto" class="form-label">Foto de perfil</label>
              <input id="userPhoto" name="userPhoto" class="form-control" type="file" />
            </div>
            <input type="hidden" name="currentPhoto" value="<?php echo $user['foto']; ?>">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveChangesButton">Actualizar datos</button>
        </div>
      </div>
    </div>
  </div>

  <?php include '../app/includes/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  


  <script>
    $(document).ready(function() {
      $('#saveChangesButton').click(function() {
        var formData = new FormData($('#updateUserForm')[0]);
        
        $.ajax({
          url: 'update_profile.php', // Archivo PHP para procesar la actualización
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
              // Actualizar los datos en el frontend sin recargar la página
              $('#userNameDisplay').text(data.nombre);
              $('#userAddressDisplay').text(data.direccion);
              $('#userFullAddress').text(data.direccion);
              $('#userPhoneDisplay').text(data.telefono);
              $('#userSexDisplay').text(data.sexo);
              $('#userDateDisplay').text(data.fecha_nacimiento);
              $('#profilePicture').attr('src', data.foto);
              
              // Cerrar el modal
              $('#updateUser').modal('hide');
            } else {
              alert('Error al actualizar los datos.');
            }
          },
          error: function() {
            alert('Error en la solicitud.');
          }
        });
      });
    });
  </script>
</body>
</html>
