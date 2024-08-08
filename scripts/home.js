function addToCart(productID) {


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
