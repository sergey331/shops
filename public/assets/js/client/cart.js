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
document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.addcart');
    const add_to_cart = e.target.closest('.add_to_cart');
    if (btn) {
        let bookId = btn.dataset.book_id;
        if (!bookId) return;
        await addCart(bookId)
    } else if (add_to_cart) {
        let bookId = add_to_cart.dataset.book_id;
        let qty = document.getElementById('quantity').value ?? '1';
        if (!bookId) return;
        await updateCartInProductPage(bookId,qty)
    }
});

async function addCart(bookId,qty = '1')
{
    try {
        const formData = new FormData();
        formData.append('book_id', bookId);
        formData.append('qty', qty);

        const res = await fetch('/cart/add', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        document.getElementById('cartData').innerHTML = data.cartHtml;

        document.querySelectorAll('.price_count')
            .forEach(el => el.textContent = `(${data.quantity})`);
        toastr.success('Book added to cart')
    } catch (err) {
        console.error('Cart error:', err);
    }
}

const cartContent = document.getElementById('cartContent');
if (cartContent) {
    cartContent.addEventListener('click', async (e) => {
        // Minus button
        if (e.target.closest('.quantity-left-minus')) {
            const btn = e.target.closest('.quantity-left-minus');
            const input = btn.nextElementSibling;
            input.value = Math.max(1, parseInt(input.value) - 1);
            await updateCart(input);
        }

        if (e.target.closest('.quantity-right-plus')) {
            const btn = e.target.closest('.quantity-right-plus');
            const input = btn.previousElementSibling;
            input.value = Math.min(100, parseInt(input.value) + 1);
            await updateCart(input);
        }

        if (e.target.closest('.remove_item')) {
            const btn = e.target.closest('.remove_item');
            const bookId = btn.dataset.bookId;
            await removeCart(bookId)
        }
    });

   cartContent.addEventListener('change', async (e) => {
        if (e.target.classList.contains('qut-inp')) {
            await updateCart(e.target);
        }
    });

}
async function updateCart(input) {
    const qty = parseInt(input.value) || 1;
    const bookId = input.dataset.bookId;
    const formData = new FormData();
    formData.append('book_id', bookId);
    formData.append('qty', qty);
    const res = await fetch('/cart/update', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    cartContent.innerHTML = data.cartContent;
    toastr.success('Cart updated successfully')
}

async function updateCartInProductPage(bookId,qty) {
    const formData = new FormData();
    formData.append('book_id', bookId);
    formData.append('qty', qty);
    const res = await fetch('/cart/edit', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    document.getElementById('cartData').innerHTML = data.cartHtml;

    document.querySelectorAll('.price_count')
        .forEach(el => el.textContent = `(${data.quantity})`);
    toastr.success('Cart updated successfully')
}


async function removeCart(bookId) {
    const formData = new FormData();
    formData.append('book_id', bookId);
    const res = await fetch('/cart/remove', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    cartContent.innerHTML = data.cartContent;
    toastr.success('Book deleted in cart')
}