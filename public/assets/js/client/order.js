let orderContent = document.getElementById('order-content');

document.addEventListener('click', async (e) => {
    const actions = {
        '#saveNext1': saveStep1,
        '#savePersonalInfo': personalInfo,
        '#savePayment': savePaymentMethod,
        '#confirmOrder': confirms,
        '.steps': changeStep
    };
    for (const selector in actions) {
        const el = e.target.closest(selector);
        if (el) {

            if (selector === '#savePersonalInfo') {
                e.preventDefault();
            }
            await actions[selector](e, el);
            break;
        }
    }
})

async function changeStep(e,el) {
    const step = el.dataset.step;
    let formData = new FormData();
    formData.append('step', step)
    await send('/checkout/update-step',formData,step)
}

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

        loadData(await response.text(),'type');

    } catch (error) {

        loadData('<p>Failed to load checkout.</p>','');
    }
}

async function saveStep1() {
    let formData = new FormData();
    const checkout_type = document.querySelector('input[name="checkout_type"]:checked').value;
    formData.append('checkout_type', checkout_type)
    await send('/checkout/save-step-1',formData,'personal_info')
}
async function confirms(e,el) {
    let formData = new FormData();
    let order_id = el.dataset.order_id;
    console.log(order_id)
    formData.append('order_id',order_id);
    await send('/checkout/confirm',formData);
}
async function savePaymentMethod() {
    let formData = new FormData();
    const payment_id = document.querySelector('input[name="payment_id"]:checked').value;
    formData.append('payment_id', payment_id)
    await send('/checkout/save-payment-method',formData, 'confirm')
}

async function personalInfo() {
    let personalInfoForm = document.getElementById('savePersonalInfoForm')
    let formData = new FormData(personalInfoForm)
    await send('/checkout/save-personal-info',formData,'payment')
}

async function send(url,formData,activeClass) {
    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });
    const data = await response.json();
    if (data.success) {
        loadData(data.content,activeClass);
    }
}

function loadData(html,active) {
    document.querySelectorAll('.steps').forEach(i => {
        i.classList.remove('border-dashed','border-primary')
    })

   if (active !== '') {
       let li = document.querySelector('.' + active);
       console.log(active)

       if (li) {
           li.classList.add('border-dashed','border-primary');
       }
   }


    orderContent.innerHTML = html;
}

loadCheckoutStep('/checkout/step-1');