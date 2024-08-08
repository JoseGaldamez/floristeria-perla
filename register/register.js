function saveRegister() {
    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    if (username == "" || email == "" || password == "" || confirmPassword == "") {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Campos Requeridos!</strong> Todos los campos son obligatorios.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        return;
    }

    if (password !== confirmPassword) {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Upss!</strong> Las contraseñas no coinciden.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        return;
    }

    $.ajax({
        type: 'POST',
        url: '../app/controller/register.controller.php',
        data: { username, email, password, confirm_password: confirmPassword, userType: 1 },
        success: function (response) {
            console.log('SUCCESS BLOCK');
            console.log(response);
            if (response.success) {
                location.href = "/"
            } else {
                document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> No se pudo guardar el usuario. Consulte son un administrador.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                return;
            }
        },
        /*holllllla*/
        error: function (response) {
            console.log('ERROR BLOCK');
            console.log(response);
            document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> No se pudo guardar el usuario. Consulte son un administrador.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            return;
        }
    });
}