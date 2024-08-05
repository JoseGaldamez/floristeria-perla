
function createOrUpdateProduct() {
    const form = document.getElementById('productForm');
    const formData = new FormData(form);
    const productId = document.getElementById("productId").value;
    const url = productId ? '../../app/controller/product.controller.php?action=update' : '../../app/controller/product.controller.php?action=create';

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            location.href = "/admin/products?success=true";
        },
        error: function (response) {
            alert("Error al guardar el producto.");
        }
    });
}

function loadProductData(productId) {
    $.ajax({
        type: 'GET',
        url: '../../app/controller/product.controller.php',
        data: { action: 'get', productId: productId },
        success: function (response) {
            const product = JSON.parse(response);
            document.getElementById("productId").value = product.productID;
            document.getElementById("productName").value = product.productName;
            document.getElementById("description").value = product.description;
            document.getElementById("price").value = product.price;
            document.getElementById("inventary").value = product.inventary;
            document.getElementById("image").value = ""; 
            document.getElementById("category").value = product.categoryID;
            document.getElementById("status").value = product.status;
            $('#addProduct').modal('show');
        },
        error: function (response) {
            alert("Error al cargar los datos del producto.");
        }
    });
}

function deactivateProduct(productId) {
    $.ajax({
        type: 'POST',
        url: '../../app/controller/product.controller.php?action=deactivate',
        data: { productId: productId },
        success: function (response) {
            location.href = "/admin/products?success=true";
        },
        error: function (response) {
            alert("Error al eliminar el producto.");
        }
    });
}

function showDeleteModal(productId) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    confirmDeleteBtn.onclick = function() {
        deactivateProduct(productId);
        deleteModal.hide();
    };

    deleteModal.show();
}
// Cargar las categorías en el select
function loadCategories() {
    $.ajax({
        type: 'GET',
        url: '../../app/controller/product.controller.php',
        data: { action: 'getCategories' },
        success: function (response) {
            const categories = JSON.parse(response);
            const categorySelect = document.getElementById("category");
            categorySelect.innerHTML = "";

            categories.forEach(function (category) {
                const option = document.createElement("option");
                option.value = category.categoryID;
                option.textContent = category.categoryName;
                categorySelect.appendChild(option);
            });
        },
        error: function (response) {
            alert("Error al cargar las categorías.");
        }
    });
}

// Se llama la función loadCategories al abrir el modal
$('#addProduct').on('show.bs.modal', function () {
    loadCategories();
});

// Desvanecer la alerta después de 5 segundos
$(document).ready(function() {
    setTimeout(function() {
        $("#success-alert").fadeOut('slow', function() {
            $(this).remove();
        });
    }, 5000);

    // Mostrar la imagen en el modal al hacer clic en ella
    $(document).on('click', '.product-image', function() {
        const src = $(this).attr('src');
        const productName = $(this).data('product-name');
        $('#modalImage').attr('src', src);
        $('#imageModalLabel').text(productName);
        $('#imageModal').modal('show');
    });
});