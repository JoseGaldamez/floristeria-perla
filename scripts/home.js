function addToCart(productID, userID) {

    if (userID == 0) {
        location.href = "/login";
    }


    $.ajax({
        type: 'POST',
        url: '../app/controller/home.controller.php',
        data: { productID },
        success: function (response) {
            console.log(response);
            location.reload()
        },
        error: function (error) {
            console.log('ERROR BLOCK');
            console.log(error);
        }
    });

}
