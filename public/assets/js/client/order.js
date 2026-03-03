let orderContent = document.getElementById('order-content');

async function loadCheckoutStep(url) {
    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        orderContent.innerHTML = await response.text();

    } catch (error) {
        console.error('Checkout load failed:', error);
        orderContent.innerHTML = '<p>Failed to load checkout.</p>';
    }
}

document.addEventListener('click', async (e) => {
    const saveNext1 = e.target.closest('#saveNext1');
    const savePersonalInfo = e.target.closest('#savePersonalInfo');
    if (saveNext1) {
        await saveStep1()
    } else if (savePersonalInfo) {
        e.preventDefault();
        await personalInfo()
    }
})

async function saveStep1() {
    let formData = new FormData();
    const checkout_type = document.querySelector('input[name="checkout_type"]:checked').value;
    formData.append('checkout_type', checkout_type)
    await send('/checkout/save-step-1',formData)
}

async function personalInfo() {
    let personalInfoForm = document.getElementById('savePersonalInfoForm')
    let formData = new FormData(personalInfoForm)
    await send('/checkout/save-personal-info',formData)
}

async function send(url,formData) {
    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });
    const data = await response.json();
    console.log(data)
    if (data.success) {
        orderContent.innerHTML = data.content;
    }
}

loadCheckoutStep('/checkout/step-1');