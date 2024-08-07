document.addEventListener('DOMContentLoaded', function() {
    // Cargar datos de categoría en el formulario modal para edición
    function loadCategoryData(categoryId) {
        $.ajax({
            url: '../../app/controller/category.controller.php',
            type: 'GET',
            data: { action: 'getCategory', categoryID: categoryId },
            success: function(response) {
                const category = JSON.parse(response);
                $('#categoryID').val(category.categoryID);
                $('#categoryName').val(category.categoryName);
                $('#description').val(category.description);
                $('#addCategory').modal('show');
            }
        });
    }

    // Crear o actualizar una categoría
    window.createOrUpdateCategory = function() {
        const categoryID = $('#categoryID').val();
        const categoryName = document.getElementById("categoryName").value;
        const description = document.getElementById("description").value;

        console.log({ categoryName, description });

        $.ajax({
            type: 'POST',
            url: '../../app/controller/category.controller.php',
            data: {
                action: categoryID ? 'updateCategory' : 'createCategory',
                categoryID: categoryID,
                categoryName: categoryName,
                description: description
            },
            success: function(_) {
                location.href = "/admin/categories?success=true";
            },
            error: function(error) {
                console.log('ERROR BLOCK');
                console.log(error);
            }
        });
    }

    // Eliminar una categoría
    function deleteCategory(categoryId) {
        $.ajax({
            url: '../../app/controller/category.controller.php',
            type: 'POST',
            data: {
                action: 'deleteCategory',
                categoryID: categoryId
            },
            success: function(_) {
                location.href = "/admin/categories?success=true";
            },
            error: function(error) {
                console.log('ERROR BLOCK');
                console.log(error);
            }
        });
    }

    // Asignar funciones a botones de editar y eliminar
    $(document).on('click', '.fa-pencil', function() {
        const categoryId = $(this).closest('tr').find('th').text();
        loadCategoryData(categoryId);
    });

    $(document).on('click', '.fa-trash', function() {
        const categoryId = $(this).closest('tr').find('th').text();
        if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
            deleteCategory(categoryId);
        }
    });

    // Asignar función de guardar al botón del modal
    $('#addCategory .btn-primary').on('click', function() {
        createOrUpdateCategory();
    });
});
