<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identify Easy way of making agency services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3f8',
                            100: '#ebe6f1',
                            500: '#5c3879',
                            600: '#4a2d61',
                            700: '#382247',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/images/img/icon/logo.jpg') }}" type="image">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        #loader-wrapper.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #5c3879;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
        .delay-4 { animation-delay: 0.8s; }
        .delay-5 { animation-delay: 1.0s; }
        .delay-6 { animation-delay: 1.2s; }
        .delay-7 { animation-delay: 1.4s; }
        .delay-8 { animation-delay: 1.6s; }

        .fade-in.delay-1, .fade-in.delay-2, .fade-in.delay-3, .fade-in.delay-4,
        .fade-in.delay-5, .fade-in.delay-6, .fade-in.delay-7, .fade-in.delay-8 {
             opacity: 0;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-primary-50 via-white to-purple-50 text-gray-800 antialiased">

    <div id="loader-wrapper">
        <div class="loader"></div>
    </div>

    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <svg class="h-8 w-auto text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <span class="ml-2 text-xl font-semibold text-gray-700">Welcome to Identify</span>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#" class="border-primary-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                    <a href="#services" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Services</a>
                    <a href="#services" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">About</a>
                    <a href="#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="overflow-hidden">
        <section class="relative py-20 sm:py-28 lg:py-32">
            <div class="absolute inset-0 bg-gradient-to-b from-white via-transparent to-transparent opacity-50 z-0"></div>
            <div class="absolute top-0 left-0 -translate-x-1/3 -translate-y-1/3 z-0 opacity-30">
                <div class="w-64 h-64 bg-purple-200 rounded-full filter blur-3xl"></div>
            </div>
            <div class="absolute bottom-0 right-0 translate-x-1/4 translate-y-1/4 z-0 opacity-30">
                <div class="w-80 h-80 bg-blue-200 rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                    <div class="lg:col-span-6 text-center lg:text-left">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 fade-in delay-1">
                            Welcome to <span class="text-primary-500">Identify,</span>
                        </h1>
                        <p class="mt-4 text-lg sm:text-xl text-gray-600 fade-in delay-2">
                            Discover innovative solutions and services designed to elevate your experience. We're glad to have you here.
                        </p>
                        <div class="mt-8 flex gap-4 justify-center lg:justify-start fade-in delay-3">
                            <a href="{{ route ('auth.login')}}" class="inline-block rounded-lg bg-primary-500 px-5 py-3 text-base font-medium text-white shadow-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                               Login
                            </a>
                            <a href="{{ route ('auth.register')}}" class="inline-block rounded-lg bg-white px-5 py-3 text-base font-medium text-primary-500 shadow-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                Register
                            </a>
                        </div>
                    </div>

                    <div class="mt-12 lg:mt-0 lg:col-span-5 flex justify-center lg:justify-end fade-in delay-4">
                         <img
                            src="{{ asset('assets/images/img/icon/img01.jpg')}}"
                            alt="Abstract welcome graphic"
                            class="rounded-xl shadow-2xl object-cover w-full max-w-md lg:max-w-none"
                            onerror="this.onerror=null; this.src='{{ asset('assets/images/img/icon/img01.jpg')}}"
                         >
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-16 sm:py-24 bg-white/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base font-semibold text-primary-500 tracking-wide uppercase fade-in delay-1">Our Services</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl fade-in delay-2">
                        What We Offer
                    </p>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 fade-in delay-3">
                        Providing top-notch solutions tailored to your needs, complete with transparent pricing.
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 fade-in delay-5">
                        <img
                            src="{{ asset('assets/images/img/icon/nimc.png')}}"
                            alt="Web Development Service Image"
                            class="h-48 w-full object-cover"
                            onerror="this.onerror=null; this.src='{{ asset('assets/images/img/icon/nimc.png')}}';"
                        >
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-medium text-gray-900">NIN services</h3>
                            <p class="mt-1 text-sm text-gray-500 flex-grow">Verify NIN using NIN, Phone number and tracking ID</p>
                        </div>
                    </div>

                    <div class="flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 fade-in delay-6">
                         <img
                            src="{{ asset('assets/images/img/icon/bvn.png')}}"
                            alt="Mobile App Service Image"
                            class="h-48 w-full object-cover"
                            onerror="this.onerror=null; this.src='{{ asset('assets/images/img/icon/bvn.png')}}';"
                         >
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-medium text-gray-900">BVN services</h3>
                            <p class="mt-1 text-sm text-gray-500 flex-grow">Verify BVN, and download slip and bvn plastics</p>
                        </div>
                    </div>

                    <div class="flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 fade-in delay-7">
                         <img
                            src="{{ asset('assets/images/img/icon/logo.jpg')}}"
                            alt="Cloud Solutions Service Image"
                            class="h-48 w-full object-cover"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x250/cccccc/ffffff?text=Cloud&font=inter';"
                         >
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-medium text-gray-900">BVN enrolment access</h3>
                            <p class="mt-1 text-sm text-gray-500 flex-grow">Become a bvn enrolment agent and get access for enrolling customers and get commision </p>
                        </div>
                    </div>

                    <div class="flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 fade-in delay-8">
                         <img
                            src="{{ asset('assets/images/img/icon/cac.png')}}"
                            alt="Security Service Image"
                            class="h-48 w-full object-cover"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x250/cccccc/ffffff?text=Security&font=inter';"
                         >
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-medium text-gray-900">Register Your Business</h3>
                            <p class="mt-1 text-sm text-gray-500 flex-grow">Upgrade your business With CAC registration.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="py-16 sm:py-24 relative bg-gradient-to-b from-primary-50 via-white to-white">
             <div class="absolute top-1/4 left-0 -translate-x-1/4 opacity-20">
                <div class="w-64 h-64 bg-purple-200 rounded-full filter blur-3xl"></div>
            </div>
             <div class="absolute bottom-1/4 right-0 translate-x-1/4 opacity-20">
                <div class="w-72 h-72 bg-blue-200 rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12">
                    <h2 class="text-base font-semibold text-primary-500 tracking-wide uppercase fade-in delay-1">Contact Us</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl fade-in delay-2">
                        Get in Touch or File a Complaint
                    </p>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 fade-in delay-3">
                        We're here to help and answer any question you might have or listen to your feedback.
                    </p>
                </div>

                <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-start">
                    <div class="mb-12 lg:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4 fade-in delay-4">Contact Information</h3>
                        <div class="space-y-4 text-gray-600 fade-in delay-5">
                            <p>
                                <strong class="font-medium text-gray-800">Address:</strong><br>
                                [Your Street Address], Samaru,<br>
                                Zaria, Kaduna State, Nigeria
                            </p>
                            <p>
                                <strong class="font-medium text-gray-800">Phone:</strong><br>
                                <a href="tel:+234XXXXXXXXXX" class="text-primary-600 hover:text-primary-800">+234 08053948114</a>
                            </p>
                            <p>
                                <strong class="font-medium text-gray-800">Email:</strong><br>
                                <a href="mailto:info@sitename.com" class="text-primary-600 hover:text-primary-800">idenfyng@gmail.com</a>
                            </p>
                        </div>

                        <h3 class="text-2xl font-semibold text-gray-900 mt-10 mb-4 fade-in delay-6">Follow Us</h3>
                        <div class="flex space-x-5 text-gray-500 fade-in delay-7">
                            <a href="#" class="hover:text-primary-600 transition duration-150 ease-in-out" aria-label="Facebook">
                                <i class="fab fa-facebook-f fa-lg"></i>
                            </a>
                            <a href="#" class="hover:text-primary-600 transition duration-150 ease-in-out" aria-label="Twitter">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="#" class="hover:text-primary-600 transition duration-150 ease-in-out" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in fa-lg"></i>
                            </a>
                            <a href="#" class="hover:text-primary-600 transition duration-150 ease-in-out" aria-label="Instagram">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                             <a href="#" class="hover:text-primary-600 transition duration-150 ease-in-out" aria-label="GitHub">
                                <i class="fab fa-github fa-lg"></i>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-lg fade-in delay-8">
                        <form action="#" method="POST">
                            <div class="grid grid-cols-1 gap-y-6">
                                <div>
                                    <label for="contact-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <div class="mt-1">
                                        <input type="text" name="name" id="contact-name" autocomplete="name" required
                                               class="block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:border-primary-500 focus:ring-primary-500">
                                    </div>
                                </div>
                                <div>
                                    <label for="contact-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <div class="mt-1">
                                        <input type="email" name="email" id="contact-email" autocomplete="email" required
                                               class="block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:border-primary-500 focus:ring-primary-500">
                                    </div>
                                </div>
                                <div>
                                    <label for="contact-subject" class="block text-sm font-medium text-gray-700">Subject / Complaint Type</label>
                                    <div class="mt-1">
                                        <input type="text" name="subject" id="contact-subject" required
                                               class="block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:border-primary-500 focus:ring-primary-500">
                                    </div>
                                </div>
                                <div>
                                    <label for="contact-message" class="block text-sm font-medium text-gray-700">Message / Complaint Details</label>
                                    <div class="mt-1">
                                        <textarea id="contact-message" name="message" rows="4" required
                                                  class="block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:border-primary-500 focus:ring-primary-500"></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit"
                                            class="w-full inline-flex justify-center rounded-lg border border-transparent bg-primary-500 px-6 py-3 text-base font-medium text-white shadow-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                        Submit Message / Complaint
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-gray-400">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <svg class="h-10 w-auto text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                     </svg>
                    <p class="text-gray-400 text-base">
                        Making the digital world better, one project at a time.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"></svg>
                        </a>
                        </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Solutions</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Websites</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Apps</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Cloud</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Security</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Company</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">About</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Blog</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Careers</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                     <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Legal</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Privacy</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 xl:text-center">&copy; {{ date('Y') }} SiteName, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        window.onload = function() {
            const loaderWrapper = document.getElementById('loader-wrapper');
            if (loaderWrapper) {
                loaderWrapper.classList.add('hidden');
            }
        };
    </script>

</body>
</html>
