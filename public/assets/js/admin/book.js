

$(document).ready(function() {
   toastr.options = {
    "debug": false,
    "newestOnTop": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",        
    "hideDuration": "1000",
    "timeOut": "3000",  
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
    $('.delete-button').click(function() {
    const image_id = $(this).data('image-id');
    const imageBox = $(this).closest('.image-box');

    showConfirm("Delete this item?", function (confirmed) {
        if (!confirmed) return;

        fetch(`/admin/books/image/delete/${image_id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                // Smooth fade-out instead of instant remove
                imageBox.fadeOut(300, function() {
                    $(this).remove();
                });
                $('#deleteBookModal').modal('hide');
                toastr.success('Image deleted successfully');
            } else {
                toastr.error('Failed to delete image');
            }
        })
        .catch(err => {
            console.error('Fetch error:', err);
            toastr.error('Server error');
        });
    });
});


    function showConfirm(message, callback) {
        $("#deleteBookModal .modal-body").text(message);

        $("#confirmDeleteBook")
        .off("click")
        .on("click", function () {
            $("#confirmDeleteBook").modal("hide");
            callback(true);
        });

        $("#deleteBookModal")
            .off("hidden.bs.modal")
            .on("hidden.bs.modal", function () {
                callback(false);
            });

        $("#deleteBookModal").modal("show");
    }
})
