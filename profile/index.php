<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "floristeria_perla";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$userData = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    // Validar y sanitizar los datos de entrada
    $name = $conn->real_escape_string($name);
    $address = $conn->real_escape_string($address);
    $phone = $conn->real_escape_string($phone);
    $gender = $conn->real_escape_string($gender);
    $birthdate = $conn->real_escape_string($birthdate);

    $sql = "UPDATE profiles SET name='$name', address='$address', phone='$phone', sex='$gender', birthday='$birthdate' WHERE userID=$userID";

    if ($conn->query($sql) === TRUE) {
        echo "Perfil actualizado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener los datos del usuario (suponiendo que el ID del usuario es 1 para este ejemplo)
$userID = 1;  // Aquí debes obtener el ID del usuario actual de alguna manera
$sql = "SELECT * FROM profiles WHERE userID = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "No se encontraron datos para este usuario.";
}

$conn->close();
?>

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

    <?php if ($userData): ?>
    <div class="row mt-5">
      <div class="col-2 align-self-center">
        <img src="../assets/imagen/placeholder.png" class="img-thumbnail rounded-circle" alt="Foto de Perfil">
      </div>
      <div class="col-8 align-self-center">
        <h3><?php echo $userData['name']; ?></h3>
        <p><?php echo $userData['location']; ?></p>
      </div>
    </div>
    <div class="text-end">
      <button type="button" class="btn text-pink" data-bs-toggle="modal" data-bs-target="#updateUser">
        <strong>Editar Información</strong>
      </button>
    </div>
    <div class="profile-card border rounded p-5 mt-5">
      <p><strong>Dirección:</strong> <?php echo $userData['address']; ?></p>
      <p><strong>Teléfono:</strong> <?php echo $userData['phone']; ?></p>
      <p><strong>Sexo:</strong> <?php echo $userData['sex']; ?></p>
      <p><strong>Fecha de nacimiento:</strong> <?php echo date("d de F de Y", strtotime($userData['birthday'])); ?></p>
    </div>

    <h4 class="text-pink mt-4">Historial de compras</h4>
    <div class="profile-card border rounded p-5 mt-5 text-center mb-5">
      <p>Sin compras por el momento...</p>
    </div>

    <form action="" method="POST" class="edit-form" id="editForm">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?php echo $userData['name']; ?>" required><br>
        <label for="address">Dirección:</label>
        <input type="text" id="address" name="address" value="<?php echo $userData['address']; ?>" required><br>
        <label for="phone">Teléfono:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $userData['phone']; ?>" required><br>
        <label for="gender">Género:</label>
        <select id="gender" name="gender" required>
            <option value="Masculino" <?php echo $userData['sex'] == 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
            <option value="Femenino" <?php echo $userData['sex'] == 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
        </select><br>
        <label for="birthdate">Fecha de nacimiento:</label>
        <input type="date" id="birthdate" name="birthdate" value="<?php echo $userData['birthday']; ?>" required><br>
        <input type="hidden" id="userID" name="userID" value="<?php echo $userData['userID']; ?>">
        <button type="submit">Guardar Cambios</button>
    </form>
    
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const editButton = document.getElementById('editButton');
      const editForm = document.getElementById('editForm');

      // Mostrar el formulario de edición al hacer clic en el botón "Editar Información"
      editButton.addEventListener('click', function () {
        editForm.style.display = 'block';
      });
    });
  </script>


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
