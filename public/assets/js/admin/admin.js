document.querySelectorAll('.dropdown-toggle').forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        this.classList.toggle('background');
        const parent = this.parentElement;
        parent.classList.toggle('open');
    });
});


document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#start_date", {
        enableTime: true,
        minDate: "today",
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
    flatpickr("#end_date", {
        enableTime: true,
        minDate: new Date(new Date().setHours(24, 0, 0, 0)),
        dateFormat: "Y-m-d H:i", // Format compatible with PHP
        time_24hr: true
    });
});

$(document).ready(function() {
    $('#options').select2({
        placeholder: "Select Options",
        allowClear: true
    });
});