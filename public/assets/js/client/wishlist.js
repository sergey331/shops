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
    const btn = e.target.closest('.addWishlist');
    if (btn) {
        let bookId = btn.dataset.book_id;

        if (!bookId) return;
        await addWishlist(bookId,btn)
    }
});

async function addWishlist(bookId,btn)
{
    try {
        const formData = new FormData();
        formData.append('book_id', bookId);
        let remove = btn.dataset.wishremove;
        const res = await fetch('/wishlist/save', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            await getWishList()
            btn.querySelector('svg').style.stroke = remove === '1' ? 'white' : 'red';
            btn.dataset.wishremove = remove === '1' ? '0' : '1';
            toastr.success(remove === '1' ? 'Book removed in wishlist' : 'Book added to wishlist')
        }
    } catch (err) {
        console.error('Cart error:', err);
    }
}
async function getWishList() {
    const res = await fetch('/wishlist/get');
    const data = await res.json();
    document.querySelector('#wishContent').innerHTML = data.wishlistContent
    document.querySelectorAll('.wishCount').forEach(item => {
        item.innerHTML = data.count
    })
}

getWishList().then(r => {
    console.log(r)
})