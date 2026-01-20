

$(document).ready(function () {
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
    $(document).on("click", ".delete-button", function () {
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
                        imageBox.fadeOut(300, function () {
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

    $("#uploadConfirm").on("click", function () {
        const $imageInput = $("#book_images");
        const $bookImages = $("#book-images");
        const bookId = $("#book_id").val();
        const files = $imageInput[0].files;

        if (!files.length) {
            toastr.error("Please select images");
            return;
        }

        const formData = new FormData();
        formData.append("book_id", bookId);

        for (const file of files) {
            formData.append("images[]", file);
        }

        $.ajax({
            url: "/admin/books/image/store",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success(res) {
                $bookImages.html(getImageHtml(res.images));
                $("#uploadImage").modal("hide");
                toastr.success("Images uploaded successfully!");
            },
            error(xhr) {
                toastr.error("Image upload failed");
                console.error(xhr.responseText);
            }
        });
    });

    $('#discount_started').datepicker({
        format: 'yyyy-mm-dd',
        enableOnReadonly: true,
        todayHighlight: true,
        autoclose: true
    });

    $('#discount_finished').datepicker({
        format: 'yyyy-mm-dd',
        enableOnReadonly: true,
        todayHighlight: true,
        autoclose: true
    });

    $("#discountSave").on('click', function () {

        clearErrors();

        const $price = $("#discount_show_price");
        const $started = $("#discount_show_started");
        const $finished = $("#discount_show_finished");

        let book_id = $('#book_id').val();

        let data = {
            price: $('#discount_price').val(),
            started_at: $('#discount_started_at').val(),
            finished_at: $('#discount_finished_at').val()
        };

        $.ajax({
            url: `/admin/books/discount/${book_id}`,
            type: "POST",
            data,
            dataType: 'json',

            success(res) {
                if (res.success) {
                    $price.html(res.discount.price);
                    $started.html(res.discount.started_at);
                    $finished.html(res.discount.finished_at);

                    $("#discountBook").modal("hide");
                    toastr.success("Discount uploaded successfully!");
                }
            },

            error(xhr) {
                showErrors(xhr.responseJSON.errors);

            }
        });
    });


    function showErrors(errors) {
        Object.keys(errors).forEach(field => {
            const el = document.getElementById(`${field}-error`);
            if (!el) return;

            el.innerHTML = errors[field].join('<br>');
            el.classList.remove('d-none');
        });
    }

    function clearErrors() {
        document.querySelectorAll('.errors').forEach(el => {
            el.innerHTML = '';
            el.classList.add('d-none');
        });
    }

    function getImageHtml(images) {
        return images.map(image => `
            <div class="image-box" style="width:150px;height:150px;position:relative">
                <button class="delete-button" data-image-id="${image.id}">
                    <i class="fa fa-trash"></i>
                </button>
                <img
                    src="/uploads/books/images/${image.image_path}"
                    alt=""
                    style="width:100%;height:100%;object-fit:cover"
                >
            </div>
        `).join("");
    }

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
