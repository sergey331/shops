<script setup>
import {Link, router} from "@inertiajs/vue3";
import Logo from "@/Components/Layout/Logo.vue";
</script>

<template >

<header class="p-[20px] bg-[#f1f1f1]">
    <nav class="flex justify-around align-center">
       <div>
           <Link href="/">
               <Logo />
           </Link>
       </div>
        <ul class="flex align-baseline gap-4">
            <li>sdg</li>
            <li>sdg</li>
            <li>sdg</li>
            <li>sdg</li>
        </ul>

        <div class=" flex gap-4">
            <Link :href="route('login')">Login</Link>
            <Link :href="route('register')">Register</Link>
        </div>
    </nav>
</header>

    <main class=" p-2 mt-[20px] m-auto w-[1400px] bg-[#f1f1f1]">
        <slot />
    </main>
</template>
