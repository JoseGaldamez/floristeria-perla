function createOrUpdateCategory() {

    const categoryName = document.getElementById("categoryName").value;
    const description = document.getElementById("description").value;

    console.log({ categoryName, description });

    $.ajax({
        type: 'POST',
        url: '../../app/controller/category.controller.php',
        data: { categoryName, description },
        success: function (response) {
            console.log('SUCCESS BLOCK');
            console.log(response);
            location.href = "/admin/categories?success=true"
        },
        error: function (response) {
            console.log('ERROR BLOCK');
            console.log(response);
        }
    });

}