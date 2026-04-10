const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('ratingInput');

stars.forEach(star => {
    star.addEventListener('click', () => {
        const value = star.dataset.value;
        ratingInput.value = value;

        stars.forEach(s => s.classList.remove('text-yellow-500'));
        stars.forEach(s => {
            if (s.dataset.value <= value) {
                s.classList.add('text-yellow-500');
            }
        });
    });
});

document.querySelector('#reviewForm').addEventListener('submit', function (e) {
    e.preventDefault()
    review(new FormData(document.querySelector('#reviewForm')))
})

async function review(formData) {
    const response = await fetch('/reviews', {
        method: 'POST',
        body: formData
    });
    const data = await response.json();
    if (data.success) {
        document.querySelector("#reviewCount").innerHTML = data.reviews_count
        document.querySelector("#reviews_content").innerHTML = data.reviews_content
        document.querySelector('#reviewForm').reset()
        document.querySelectorAll('.star').forEach(s => s.classList.remove('text-yellow-500'));
    }
}