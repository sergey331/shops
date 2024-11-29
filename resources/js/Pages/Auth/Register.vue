<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import {ref} from "vue";
const form = useForm({
    first_name: '',
    last_name: '',
    birthday: '',
    email: '',
    password: '',
    password_confirmation: '',
});
const formatter = ref({
    date: 'YYYY-MM-DD',
    month: 'MM',
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

  <section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-[#7ad3f62a] flex rounded-2xl shadow-lg max-w-3xl p-4">

      <div class="sm:w-1/2 px-16">
        <h2 class="font-bold text-2xl text-[#4527a5] text-center">Register</h2>

        <!--Data entry group-->
        <form class="flex flex-col gap-4" action="">
          <input class="p-2 mt-8 rounded-xl border" type="text"  v-model="form.first_name" placeholder="First name">
          <input class="p-2 mt-8 rounded-xl border" type="text"  v-model="form.last_name" placeholder="Last name">
          <input class="p-2 mt-8 rounded-xl border" type="text"  v-model="form.email" placeholder="Email">
          <div class="relative">
            <input class="p-2 mt-8 rounded-xl border w-full" type="password"  v-model="form.password" placeholder="Password">

            <svg class="bi bi-eye-fill absolute top-1/2 right-4
                    translate-y-1/2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" viewBox="0 0 16 16">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
          </div>
            <div class="relative">
            <input class="p-2 mt-8 rounded-xl border w-full" type="password"  v-model="form.password_confirmation" placeholder="Repeat Password">

            <svg class="bi bi-eye-fill absolute top-1/2 right-4
                    translate-y-1/2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" viewBox="0 0 16 16">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
          </div>

          <button class="Login-button rounded-xl text-white py-2">Register</button>
        </form>



        <div class="mt-3 text-xs flex justify-between items-center">
          <p>
            <a href="#">If you have an account?</a>
          </p>
          <Link class="py-2 px-5 bg-white border rounded-xl" href="/login">Login</Link>
        </div>
      </div>

      <!--Image-->
      <div class="sm:block hidden w-1/2">
        <img class="sm:block hidden rounded-2xl" src="https://sidneyteodorojr.github.io/login_page-tailwind/img/login.jpeg" alt="img-login">
      </div>
    </div>
    <!--===============-->
  </section>
</template>
<style scoped>
.Login-button {
    background: linear-gradient(to right, #5234b3,#03a9f4);
}

/* Hovering over the element triggers a visual effect of a linear gradient in the background, changing color, creating an effect when interacting with the button. */
.Login-button:hover {
    background: linear-gradient(to   right, #8138f6ad, #03a8f4ab);
}

/* Defining the font of the texts */
h2, p {
    font-family: 'Poppins', sans-serif;
}

/* Changes color when hovering the mouse over the link */
a:hover {
    color: #1445e8;
}
</style>
