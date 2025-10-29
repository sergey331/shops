@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-wrap">
            <div class="w-full ">
                <div class="flex flex-col lg:flex-row-reverse gap-8">
                    <!-- Inquiry Form -->
                    <div class="w-full lg:w-1/2 mb-8">
                        <h3 class="text-xl uppercase font-bold mb-4">Got any questions?</h3>
                        <p class="mb-6">Use the form below to get in touch with us.</p>
                        <form id="contactForm" class="mt-6">
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <div class="w-full">
                                    <label class="block text-gray-700 mb-2">Your Name*</label>
                                    <input type="text" name="name" placeholder="Write Your Name Here"
                                           class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"
                                           required>
                                </div>
                                <div class="w-full">
                                    <label class="block text-gray-700 mb-2">Your E-mail*</label>
                                    <input type="email" name="email" placeholder="Write Your Email Here"
                                           class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"
                                           required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" placeholder="Phone Number"
                                       class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Subject</label>
                                <input type="text" name="subject" placeholder="Write Your Subject Here"
                                       class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Your Message*</label>
                                <textarea name="message" placeholder="Write Your Message Here"
                                          class="w-full px-4 py-2 border border-gray-300 h-36 focus:border-gray-800 focus:outline-none focus:ring-0"
                                          required></textarea>
                            </div>
                            <button type="submit"
                                    class="w-full bg-primary text-white px-4 py-3 mt-4 transition duration-300">Submit</button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="w-full lg:w-1/2 mb-8">
                        <h3 class="text-xl uppercase font-bold mb-4">Contact information</h3>
                        <p class="mb-8">Tortor dignissim convallis aenean et tortor at risus viverra adipiscing.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Head Office -->
                            <div class="mb-8">
                                <h5 class="text-lg font-bold mb-4">Head Office</h5>
                                <div class="space-y-2">
                                    <p class="text-gray-700">730 Glenstone Ave 65802, Springfield, US</p>
                                    <div class="text-gray-700">
                                        <a href="tel:+123987321" class="hover:text-primary">+123 987 321</a>,
                                        <a href="tel:+123123654" class="hover:text-primary">+123 123 654</a>
                                    </div>
                                    <p class="text-gray-700">
                                        <a href="#" class="hover:text-primary">headbranch@yourcompanycom</a>
                                    </p>
                                </div>
                            </div>

                            <!-- Branch Office -->
                            <div class="mb-8">
                                <h5 class="text-lg font-bold mb-4">Branch Office</h5>
                                <div class="space-y-2">
                                    <p class="text-gray-700">730 Glenstone Ave 65802, Springfield, US</p>
                                    <div class="text-gray-700">
                                        <a href="tel:+123987321" class="hover:text-primary">+123 987 321</a>,
                                        <a href="tel:+123123654" class="hover:text-primary">+123 123 654</a>
                                    </div>
                                    <p class="text-gray-700">
                                        <a href="#" class="hover:text-primary">contactbranch@yourcompany.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="mt-4">
                            <h5 class="text-lg font-bold mb-4">Social info</h5>
                            <ul class="flex space-x-4 list-none">
                                <li>
                                    <a href="#">
                                        <svg class="facebook w-6 h-6 text-gray-400 hover:text-primary">
                                            <use xlink:href="#facebook" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="instagram w-6 h-6 text-gray-400 hover:text-primary">
                                            <use xlink:href="#instagram" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="twitter w-6 h-6 text-gray-400 hover:text-primary">
                                            <use xlink:href="#twitter" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="linkedin w-6 h-6 text-gray-400 hover:text-primary">
                                            <use xlink:href="#linkedin" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="youtube w-6 h-6 text-gray-400 hover:text-primary">
                                            <use xlink:href="#youtube" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('Component.Home.instagram')