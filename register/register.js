document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        e.preventDefault(); 

        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;

        console.log({ username, email, password, confirmPassword });

        $.ajax({
            type: 'POST',
            url: '../../app/controller/register.controller.php',
            data: { username, email, password, confirm_password: confirmPassword },
            success: function (response) {
                console.log('SUCCESS BLOCK');
                console.log(response);
                alert(response.message);
                if (response.success) {
                    location.href = "/admin/Registros?success=true"
                }
            },
            /*holllllla*/
            error: function (response) {
                console.log('ERROR BLOCK');
                console.log(response);
                alert("Error en el registro de usuario. Por favor, intente nuevamente.");
            }
        });
    });
});