function pay(orderID, total) {

    const card = document.getElementById("numbercard").value;
    const name = document.getElementById("namecard").value;
    const expiration = document.getElementById("expirationDate").value;
    const details = document.getElementById("details").value;

    console.log({ card, name, expiration, details, orderID, total });

    if (card.length < 16) {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> El número de tarjeta debe tener 16 digitos.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (name.length == 0) {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> Ingrese el nombre del propietarios de la tarjeta.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (expiration.length < 5 || !expiration.includes("/")) {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> Ingrese una fecha de expiración válida en el formato 00/00.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (details.length < 5) {
        document.getElementById("alerts").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Upss!</strong> Ingrese detalles sobre el pedido, fecha de entrega, texto de tarjeta, dedicatoria, etc..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    $.ajax({
        type: 'POST',
        url: '../app/controller/order.controller.php',
        data: { card, name, expiration, details, orderID, total },
        success: function (response) {
            console.log('SUCCESS BLOCK');
            console.log(response);
            if (response.success) {
                location.href = "/cart?success=true"
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