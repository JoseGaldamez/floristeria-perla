function updateProfile() {
    const name = document.getElementById("name").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const sex = document.getElementById("sex").value;
    const birthday = document.getElementById("birthday").value;

    $.ajax({
        type: 'POST',
        url: '../app/controller/profile.controller.php',
        data: { name, address, phone, sex, birthday },
        success: function (response) {
            console.log('SUCCESS BLOCK');
            console.log(response);
            if (response.success) {
                location.href = "/profile?success=true"
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