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
    </style>
</head>
<body>
  <div class="container">
    <h2 class="text-pink">Perfil de usuario</h2>
    <div class="profile-card">
      <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Foto de Perfil">
      <h3>Nombre de Usuario</h3>
      <p>El Progreso, Yoro, Honduras</p>
      <p><strong>Dirección:</strong> El Progreso, Yoro, Honduras</p>
      <p><strong>Teléfono:</strong> +504 3175 1455</p>
      <p><strong>Género:</strong> Masculino</p>
      <p><strong>Fecha de nacimiento:</strong> 15 de septiembre de 1991</p>
    </div>
    <h4 class="text-pink mt-4">Historial de compras</h4>
    <div class="purchase-history">
      <p>Sin compras por el momento...</p>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const profileCard = document.querySelector('.profile-card');
      const profilePic = profileCard.querySelector('img');
      const profileName = profileCard.querySelector('h3');
      const profileLocation = profileCard.querySelector('p:nth-child(3)');
      const profileDetails = profileCard.querySelectorAll('p');
      const purchaseHistoryContainer = document.querySelector('.purchase-history');
      const purchaseHistory = purchaseHistoryContainer.querySelector('p');

      // Ejemplo de datos de usuario (estos datos pueden ser obtenidos de un formulario o una API)
      const userData = {
        name: 'Juan Pérez',
        location: 'El Progreso, Yoro, Honduras',
        address: 'El Progreso, Yoro, Honduras',
        phone: '+504 3175 1455',
        gender: 'Masculino',
        birthdate: '15 de septiembre de 1991',
        profilePicUrl: 'https://via.placeholder.com/150',
        purchases: []
      };

      // Función para actualizar la información del perfil
      function updateProfile(user) {
        profileName.textContent = user.name;
        profileLocation.textContent = user.location;
        profileDetails[1].innerHTML = `<strong>Dirección:</strong> ${user.address}`;
        profileDetails[2].innerHTML = `<strong>Teléfono:</strong> ${user.phone}`;
        profileDetails[3].innerHTML = `<strong>Género:</strong> ${user.gender}`;
        profileDetails[4].innerHTML = `<strong>Fecha de nacimiento:</strong> ${user.birthdate}`;
        profilePic.src = user.profilePicUrl;

        // Actualizar historial de compras
        if (user.purchases.length === 0) {
          purchaseHistory.textContent = 'Sin compras por el momento...';
        } else {
          purchaseHistoryContainer.innerHTML = '';
          user.purchases.forEach(purchase => {
            const purchaseItem = document.createElement('p');
            purchaseItem.textContent = `${purchase.date}: ${purchase.description} - ${purchase.amount}`;
            purchaseHistoryContainer.appendChild(purchaseItem);
          });
        }
      }

      // Llamar a la función para actualizar el perfil con los datos de usuario
      updateProfile(userData);

      // Ejemplo de cómo añadir una compra al historial (esto puede ser parte de un formulario)
      function addPurchase(date, description, amount) {
        userData.purchases.push({ date, description, amount });
        updateProfile(userData);
      }

      // Ejemplo de uso: añadir una compra después de 3 segundos
      setTimeout(() => {
       
      }, 3000);
    });
  </script>
</body>
</html>