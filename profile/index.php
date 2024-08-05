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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
    </style>
    
    <style>
        body {
            background-color: #d0e4f8;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fdeef4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .text-pink {
            color: #ff4081;
        }

        .img-thumbnail {
            max-width: 150px;
            border-radius: 50%;
            margin: 0 auto 10px;
        }

        .profile-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .profile-card p {
            margin: 5px 0;
            color: #6c757d;
            text-align: justify;
        }

        .profile-card strong {
            color: #343a40;
        }

        .purchase-history {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .purchase-history p {
            margin: 0;
            text-align: center;
        }

        .edit-form {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
  <div class="container">
    <h2 class="text-pink">Perfil de usuario</h2>
    <?php if ($userData): ?>
    <div class="profile-card">
      <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Foto de Perfil">
      <h3><?php echo $userData['name']; ?></h3>
      <p><?php echo $userData['location']; ?></p>
      <p><strong>Dirección:</strong> <?php echo $userData['address']; ?></p>
      <p><strong>Teléfono:</strong> <?php echo $userData['phone']; ?></p>
      <p><strong>Género:</strong> <?php echo $userData['sex']; ?></p>
      <p><strong>Fecha de nacimiento:</strong> <?php echo date("d de F de Y", strtotime($userData['birthday'])); ?></p>
      <button id="editButton">Editar Información</button>
    </div>
    <h4 class="text-pink mt-4">Historial de compras</h4>
    <div class="purchase-history">
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
    <?php endif; ?>
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
</body>
</html>
