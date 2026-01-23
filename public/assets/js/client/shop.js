// DOM Elements
const booksContainer = document.getElementById('books');
const loader = document.getElementById('books-loader');
const searchInput = document.getElementById('search_input');
const searchButton = document.getElementById('search');

// Multi-dropdown setup
document.querySelectorAll('.dropdown-container').forEach(container => {
    const button = container.querySelector('.dropdown-button');
    const menu = container.querySelector('.dropdown-menu');
    const selectedContainer = container.querySelector('.selected-container');
    const placeholder = selectedContainer.querySelector('.placeholder');

    // Toggle dropdown
    button.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', e => {
        if (!container.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // Update selected pills and trigger filter
    menu.querySelectorAll('.checkbox').forEach(cb => {
        cb.addEventListener('change', () => {
            const selected = Array.from(menu.querySelectorAll('.checkbox:checked'));
            selectedContainer.innerHTML = '';
            if (selected.length === 0) {
                selectedContainer.appendChild(placeholder);
            } else {
                selected.forEach(el => {
                    const span = document.createElement('span');
                    span.textContent = el.parentElement.textContent.trim();
                    span.className = 'bg-primary text-white px-2 py-0.5 rounded-full text-xs flex items-center';
                    selectedContainer.appendChild(span);
                });
            }
            filter();
        });
    });
});

// Search button + enter key
searchButton.addEventListener('click', filter);
searchInput.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
        e.preventDefault();
        filter();
    }
});

// Loader functions
function showLoader() {
    loader.classList.remove('hidden');
    booksContainer.classList.add('opacity-50');
}
function hideLoader() {
    loader.classList.add('hidden');
    booksContainer.classList.remove('opacity-50');
}

// Get selected values from all dropdowns
function getSelectedValues() {
    const data = {};
    document.querySelectorAll('.dropdown-container').forEach(container => {
        const key = container.dataset.name; // safer than placeholder
        data[key] = Array.from(container.querySelectorAll('.checkbox:checked')).map(cb => cb.value);
    });
    return data;
}

// AJAX filter
function filter() {
    showLoader();

    const params = new URLSearchParams();
    params.append('search', searchInput.value);

    const selectedData = getSelectedValues();
    for (const key in selectedData) {
        selectedData[key].forEach(val => params.append(`${key}[]`, val));
    }

    fetch('/shop/filter?' + params.toString(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(res => res.text())
        .then(html => booksContainer.innerHTML = html)
        .catch(() => booksContainer.innerHTML = '<p class="text-red-500">Failed to load books</p>')
        .finally(hideLoader);
}
