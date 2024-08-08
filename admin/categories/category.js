function createCategory() {
    const categoryID = document.getElementById("idCategorySelected").value;
    const categoryName = document.getElementById("categoryName").value;
    const description = document.getElementById("description").value;

    console.log({ categoryName, description });

    $.ajax({
        type: 'POST',
        url: '../../app/controller/category.controller.php',
        data: {
            action: (categoryID !== "") ? 'updateCategory' : 'createCategory',
            categoryID: Number.parseInt(categoryID),
            categoryName: categoryName,
            description: description
        },
        success: function (response) {
            console.log(response);

            location.href = "/admin/categories?success=true";
        },
        error: function (error) {
            console.log('ERROR BLOCK');
            console.log(error);
        }
    });
}

function selectCategory(categoryID, categoryName, description) {
    document.getElementById("idCategorySelected").value = categoryID;
    document.getElementById("categoryName").value = categoryName;
    document.getElementById("description").value = description;
}

function clearSelectedCategory() {
    document.getElementById("idCategorySelected").value = "";
    document.getElementById("categoryName").value = "";
    document.getElementById("description").value = "";
}

function deleteCategory(categoryID) {

    $.ajax({
        type: 'POST',
        url: '../../app/controller/category.controller.php',
        data: {
            action: 'deleteCategory',
            categoryID: Number.parseInt(categoryID),
            categoryName: "categoryName",
            description: "description"
        },
        success: function (response) {
            console.log(response);

            location.href = "/admin/categories?success=true";
        },
        error: function (error) {
            console.log('ERROR BLOCK');
            console.log(error);
        }
    });

}