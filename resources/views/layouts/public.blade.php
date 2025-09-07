<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">


       <title>@yield('title', 'SynFlow AI')</title>


       <link rel="preconnect" href="https://fonts.bunny.net">
       <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


       @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
   <body class="font-sans antialiased bg-gray-50 text-gray-800">
       <div class="min-h-screen flex flex-col">
           <header class="bg-white shadow-sm sticky top-0 z-50">
               <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                   <nav class="flex justify-between items-center h-16">
                       <div class="flex items-center">
                           <a href="{{ route('home') }}" class="flex items-center">
                               <img src="{{ asset('images/synflowlogo.jpeg') }}" alt="SailRizon AI Logo" class="h-16 w-40 object-contain">
                           </a>
                       </div>




                       <div class="hidden md:flex space-x-8">
                           <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Home</a>
                           <a href="{{ route('about') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">About</a>
                           <a href="{{ route('pricing') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Pricing</a>
                           <a href="{{ route('services') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Services</a>
                            <a href="{{ route('documentation') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Documentation</a>
                           <a href="{{ route('contact') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Contact</a>
                       </div>


                       <!--<div class="hidden md:flex items-center space-x-4">
                           <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Log in</a>
                           <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                               Register
                           </a>
                       </div> -->
                       <div class="hidden md:flex items-center space-x-4">
                           <a href="#" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">0737955021</a>
                           <a href="{{ route('contactus') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                               Get Started
                           </a>
                       </div>
                      
                       <div class="md:hidden">
                           </div>
                   </nav>
               </div>
           </header>


           <main class="flex-grow">
               @yield('content')
           </main>


           <!-- A modern, professional footer with multiple sections for links and contact info. -->
           <footer class="bg-gray-900 text-gray-300 mt-12 py-10 sm:py-16">
               <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                   <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                       <!-- Company Info Section -->
                       <div>
                           <h4 class="text-xl font-bold text-white mb-4">SynFlow AI</h4>
                           <p class="text-sm leading-relaxed">
                               We specialize in AI strategy, autonomous agent development, and enterprise consulting to help businesses thrive in the digital age.
                           </p>
                           <p class="text-sm mt-4">&copy; {{ date('Y') }} SynFlow AI. All Rights Reserved.</p>
                       </div>
                      
                       <!-- Quick Links Section -->
                       <div>
                           <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
                           <ul class="space-y-2">
                               <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                               <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                               <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a></li>
                               <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                               <li><a href="{{ route('faqs') }}" class="hover:text-white transition-colors">FAQ's</a></li>
                           </ul>
                       </div>


                       <!-- Legal Section -->
                       <div>
                           <h4 class="text-lg font-semibold text-white mb-4">Legal</h4>
                           <ul class="space-y-2">
                               <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a></li>
                               <li><a href="{{ route('policy') }}" class="hover:text-white transition-colors">Privacy Policy</a></li>
                               <li><a href="{{ route('contactus') }}" class="hover:text-white transition-colors">Get in Touch&#8599;</a></li>
                                <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers&#8599;</a></li>
                                <li><a href="https://www.youtube.com/@SynFlowAI" class="hover:text-white transition-colors">Watch our Content here&#8599;</a></li>
                           </ul>
                       </div>
                      
                       <!-- Contact Info Section -->
                       <div>
                           <h4 class="text-lg font-semibold text-white mb-4">Contact</h4>
                           <ul class="space-y-2">
                               <li class="flex items-center space-x-2">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                   </svg>
                                   <span>info@synflow.ai</span>
                               </li>
                               <li class="flex items-start space-x-2">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                   </svg>
                                   <span>P.O. Box 4000-00100, Nairobi, Kenya</span>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
           </footer>
       </div>
   </body>
</html>
