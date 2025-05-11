document.querySelectorAll('.dropdown-toggle').forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        this.classList.toggle('background');
        const parent = this.parentElement;
        parent.classList.toggle('open');
    });
});
