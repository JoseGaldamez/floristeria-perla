function addToCart(productID) {


    $.ajax({
        type: 'POST',
        url: '../app/controller/home.controller.php',
        data: { productID, userID: 6 },
        success: function (_) {
            location.reload()
        },
        error: function (error) {
            console.log('ERROR BLOCK');
            console.log(error);
        }
    });

}