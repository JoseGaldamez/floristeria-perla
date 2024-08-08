<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../styles/global.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
  </style>
</head>

<body>


  <?php
  include '../app/includes/menu.php';
  include_once '../app/model/register.model.php';
  include_once '../app/conn/conn.php';


  session_start();

  $userID = 0;
  if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
  }

  $user = getUserByID($conn, $userID);

  if ($user->num_rows > 0) {
    while ($row = $user->fetch_assoc()) {
      $userName = htmlspecialchars($row["userName"]);
      $userEmail = htmlspecialchars($row["userEmail"]);
    }
    $profile = getOrCreateUserProfile($conn, $userID, $userName);

    if ($profile->num_rows > 0) {

      while ($row = $profile->fetch_assoc()) {
        $userName = htmlspecialchars($row["name"]);
        $address = htmlspecialchars($row["address"]);
        $phone = htmlspecialchars($row["phone"]);
        $sex = htmlspecialchars($row["sex"]);
        $birthday = htmlspecialchars($row["birthday"]);
      }
    }
  } else {
    // header('Location: /login');
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
        <h3> <?php echo $userName; ?> </h3>
        <p><?php echo $userEmail; ?></p>
      </div>
    </div>
    <div class="text-end">
      <button type="button" class="btn text-pink" data-bs-toggle="modal" data-bs-target="#updateProfileForm">
        <strong>Editar Información</strong>
      </button>
    </div>
    <?php
    if (isset($_GET['success']) && $_GET['success'] === "true") {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> Usuario guardado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>
    <div class="profile-card border rounded p-5 mt-5">
      <p><strong>Dirección:</strong> <?php echo $address; ?></p>
      <p><strong>Teléfono:</strong> <?php echo $phone; ?></p>
      <p><strong>Sexo:</strong> <?php
                                if ($sex == 0) {
                                  echo "Femenino";
                                } else {
                                  echo "Masculino";
                                } ?></p>
      <p><strong>Fecha de nacimiento:</strong> <?php echo $birthday; ?></p>



    </div>

    <h4 class="text-pink mt-4">Historial de compras</h4>
    <div class="profile-card border rounded p-5 mt-5 mb-5">

      <?php
      include_once '../app/model/order.model.php';

      $resultCompleteOrders = getCompletedOrderByUser($conn, $userID);

      if ($resultCompleteOrders->num_rows > 0) {

        echo '<table class="table"><thead><tr><th scope="col">#</th><th scope="col text-start">Detalles</th><th scope="col">Fecha</th><th scope="col">Total</th></tr></thead><tbody>';

        while ($rowOrder = $resultCompleteOrders->fetch_assoc()) {
          echo '<tr><th scope="row">' . $rowOrder["orderID"] . '</th><td>' . $rowOrder["details"] . '</td><td>' . $rowOrder["updated_at"] . '</td> <td>' . $rowOrder["total"] . '</td> </tr>';
        }

        echo '</tbody></table>';
      } else {
        echo '<p class="text-center">Sin compras por el momento...</p>';
      }



      ?>


    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="updateProfileForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar/Agregar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="UserName" class="form-label">Nombre de usuario</label>
              <input type="text" value="<?php echo $userName; ?>" class="form-control" id="name" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
              <label for="userPassword" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" placeholder="Su dirección" required><?php echo $address; ?></textarea>
            </div>
            <div class="mb-3">
              <label for="userPassword2" class="form-label">Teléfono</label>
              <input type="text" value="<?php echo $phone; ?>" class="form-control" id="phone" placeholder="+504 0000 0000" required>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Sexo</label>
              <select class="form-control" value="<?php echo $sex; ?>" id="sex" name="status" required>
                <option value="0" <?php
                                  if ($sex == 0) {
                                    echo "selected";
                                  }
                                  ?>>Femenino</option>
                <option value="1" <?php
                                  if ($sex == 1) {
                                    echo "selected";
                                  }
                                  ?>>Masculino</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="userPassword2" class="form-label">Fecha de nacimiento: </label>
              <input type="date" value="<?php echo $birthday; ?>" class="form-control" id="birthday" placeholder="Fecha de nacimiento" required>
            </div>
          </form>
          <div id="alerts" class="mt-5">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button onclick="updateProfile()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="profile.js"></script>

  <?php include '../app/includes/footer.php'; ?>


</body>

</html>