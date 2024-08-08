function login() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    $.ajax({
        type: 'POST',
        url: '../app/controller/login.controller.php',
        data: { email, password },
        success: function (response) {
            console.log('SUCCESS BLOCK');
            console.log(response);
            if (response.success) {
                location.href = "/"
            } else {
                document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Incorrecto!</strong> Verifique sus credenciales.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        },
        error: function (response) {
            console.log('ERROR BLOCK');
            console.log(response);
            document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Incorrecto!</strong> Verifique sus credenciales.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            return;
        }
    });
}