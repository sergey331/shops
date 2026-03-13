let orderContent = document.getElementById('order-content');

document.addEventListener('click', async (e) => {
    const saveNext1 = e.target.closest('#saveNext1');
    const savePersonalInfo = e.target.closest('#savePersonalInfo');
    const savePayment = e.target.closest('#savePayment');
    const confirmOrder = e.target.closest('#confirmOrder');
    if (saveNext1) {
        await saveStep1()
    } else if (savePersonalInfo) {
        e.preventDefault();
        await personalInfo();
    } else if (savePayment) {
        await  savePaymentMethod();
    } else if (confirmOrder) {
        await  confirms();
    }
})

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

        loadData(await response.text());

    } catch (error) {
        loadData('<p>Failed to load checkout.</p>');
    }
}

async function saveStep1() {
    let formData = new FormData();
    const checkout_type = document.querySelector('input[name="checkout_type"]:checked').value;
    formData.append('checkout_type', checkout_type)
    await send('/checkout/save-step-1',formData)
}
async function confirms() {
    let formData = new FormData();

}
async function savePaymentMethod() {
    let formData = new FormData();
    const payment_id = document.querySelector('input[name="payment_id"]:checked').value;
    formData.append('payment_id', payment_id)
    await send('/checkout/save-payment-method',formData)
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
    if (data.success) {
        loadData(data.content);
    }
}

function loadData(html) {
    orderContent.innerHTML = html;
}

loadCheckoutStep('/checkout/step-1');