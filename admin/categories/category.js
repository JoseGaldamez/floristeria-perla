function createOrUpdateCategory() {

    const categoryName = document.getElementById("categoryName").value;
    const description = document.getElementById("description").value;

    console.log({ categoryName, description });

    $.ajax({
        type: 'POST',
        url: '../../app/controller/category.controller.php',
        data: { categoryName, description },
        success: function (_) {
            // Recargando con parámetro de confirmación de éxito
            // Considere incluir el mensaje recibido como parámetro también? 
            // o solo en caso de error?
            location.href = "/admin/categories?success=true"
        },
        error: function (error) {
            console.log('ERROR BLOCK');
            console.log(error);
        }
    });

}