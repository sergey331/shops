document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.addcart');
    if (!btn) return;

    const bookId = btn.dataset.book_id;
    if (!bookId) return;

    try {
        const formData = new FormData();
        formData.append('book_id', bookId);

        const res = await fetch('/cart/add', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        document.getElementById('cartData').innerHTML = data.cartHtml;

        document.querySelectorAll('.price_count')
            .forEach(el => el.textContent = `(${data.quantity})`);

    } catch (err) {
        console.error('Cart error:', err);
    }
});

const cartContent = document.getElementById('cartContent');

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
});
cartContent.addEventListener('change', async (e) => {
    if (e.target.classList.contains('qut-inp')) {
        await updateCart(e.target);
    }
});

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
}
