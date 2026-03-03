<div class="min-h-screen bg-gray-50 flex justify-center p-6">
    <div class="w-full bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>


        <form class="mx-auto" id="savePersonalInfoForm">
            <div class="grid md:grid-cols-2 md:gap-6 mb-5">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="first_name"
                            id="first_name"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="first_name"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        First name*
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="last_name"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Last name*
                    </label>
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6 mb-5">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="tel"
                            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                            name="phone"
                            id="phone"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="phone"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Phone number*
                    </label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="email"
                            id="email"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="email"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Email*
                    </label>
                </div>
            </div>


            <div class="grid md:grid-cols-2 md:gap-6 mb-5">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="region_id" class="block mb-2.5 text-sm font-medium text-heading">Region</label>
                    <select id="region_id" name="region_id" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                        <option selected>Choose a region</option>
                        @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="city"
                            id="city"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="city"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        City
                    </label>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 mb-5">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="address"
                            id="address"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="address"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Address
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="address1"
                            id="address1"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="address1"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Address 1
                    </label>
                </div>
            </div>


            <div class="grid md:grid-cols-2 md:gap-6 mb-5">
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="zip"
                            id="zip"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="zip"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Zip
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                            type="text"
                            name="company"
                            id="company"
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                            placeholder=" "
                    />
                    <label
                            for="company"
                            class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >
                        Company (Ex. Google)
                    </label>
                </div>
            </div>



            <button id="savePersonalInfo" class="flex items-center justify-between py-2 text-white px-5 font-medium rtl:text-right text-body rounded  hover:text-heading bg-primary hover:bg-neutral-secondary-medium gap-3">Next</button>
        </form>

    </div>
</div>