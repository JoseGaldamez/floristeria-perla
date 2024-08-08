function createOrUpdateUser() {
    const userName = document.getElementById('UserName').value;
    const userEmail = document.getElementById('UserEmail').value;
    const userPassword = document.getElementById('userPassword').value;
    const userPassword2 = document.getElementById('userPassword2').value;


    if (userName == "" || userEmail == "" || userPassword == "" || userPassword2 == "") {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Campos Requeridos!</strong> Todos los campos son obligatorios.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        return;
    }

    if (userPassword !== userPassword2) {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Upss!</strong> Las contraseñas no coinciden.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        return;
    }

    $.ajax({
        type: 'POST',
        url: '../../app/controller/register.controller.php',
        data: { username: userName, email: userEmail, password: userPassword, confirm_password: userPassword2, userType: 2 },
        success: function (response) {
            console.log('SUCCESS BLOCK');
            console.log(response);
            if (response.success) {
                location.href = "/admin/users?success=true"
            }
        },
        error: function (response) {
            console.log('ERROR BLOCK');
            console.log(response);
            document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> No se pudo guardar el usuario. Consulte son un administrador.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            return;
        }
    });
}