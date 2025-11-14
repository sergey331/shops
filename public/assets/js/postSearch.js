document.addEventListener('DOMContentLoaded', () => {
    const categories = document.querySelectorAll('.categories');
    const tags = document.querySelectorAll('.tags');
    const form = document.getElementById('searchForm');
    const search = document.getElementById('search');
    categories.forEach(cb => {
        cb.addEventListener('change', e => {
            if (e.target.checked) {
                categories.forEach(other => {
                    if (other !== e.target) other.checked = false;
                });
            }
            if (form)  form.submit();
        });
    });
    tags.forEach(cb => {
        cb.addEventListener('change', e => {
            if (form)  form.submit();
        });
    });
    search.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.submit();
        }
    });
});