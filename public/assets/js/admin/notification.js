async function get() {
    const response = await fetch('/admin/notification');
    document.querySelector('#notification').innerHTML = await response.text()
}

get()