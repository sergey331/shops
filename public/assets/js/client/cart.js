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
