<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>FUSIONBODY</title>
        <!-- Swiper -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    </head>

    <body class="bg-white">
        {{-- Navbar --}}
        <nav id="navbar" class="flex flex-wrap py-0 px-10 items-center justify-between w-full h-auto bg-black-252525 mt-0 z-10 top-0 rounded-b-[48px]">
            <div class="flex py-4">
                <a href="#" class="flex items-center font-barlow text-green-d5ff40 no-underline">
                    <span class="self-center whitespace-nowrap text-4xl font-bold transition-colors duration-300 transform hover:text-white uppercase">fusionbody</span>
                </a>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-6 w-6 cursor-pointer md:hidden block text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <div id="menu" class="hidden w-full md:flex md:items-center md:w-auto">
                <ul class="pt-4 text-lg text-white md:flex md:justify-between md:pt-0 font-barlow font-medium">
                    <li>
                        <a href="#home" class="px-4 py-2 block no-underline transition-colors duration-300 transform hover:text-green-d5ff40 hover:text-underline active:text-green-d5ff40">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="px-4 py-2 block no-underline transition-colors duration-300 transform hover:text-green-d5ff40 hover:text-underline active:text-green-d5ff40">
                            About us
                        </a>
                    </li>
                    <li>
                        <a href="#package" class="px-4 py-2 block no-underline transition-colors duration-300 transform hover:text-green-d5ff40 hover:text-underline active:text-green-d5ff40">
                            Features
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="px-4 py-2 block no-underline transition-colors duration-300 transform hover:text-green-d5ff40 hover: hover:text-underline active:text-green-d5ff40">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Home --}}
        <header id="home" class="overflow-hidden h-screen">
            <div class="container mx-auto py-0 2xl:mt-10 mt-5 flex justify-center">
                <div class="w-auto bg-black-252525 rounded-[56px]">
                    <img src={{ asset ('img/Ornament73.png') }} alt="ornament1" class="inset-0 md:w-full w-635 h-14 object-fill obje md:rounded-t-[56px] rounded-t-full">
                    <div class="flex justify-between items-center px-10 pt-3">   
                        <div class="flex">
                            <p class="font-barlow 4xl:text-8xl 3xl:text-7.5xl md:text-4xl sm:text-2xl text-xl font-medium capitalize text-white">transform your body</p>
                        </div>   
                        <div class="flex">
                            <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="xl:p-2 2xl:w-48 2xl:h-24 p-1 md:w-24 md:h-12 sm:w-20 sm:h-10 w-16 h-8">
                            <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="xl:p-2 2xl:w-48 2xl:h-24 p-1 md:w-24 md:h-12 sm:w-20 sm:h-10 w-16 h-8">
                        </div>                  
                    </div>
                    <div class="flex justify-center items-center py-5 px-10 font-barlow">
                        <p class="4xl:text-7xl 3xl:text-6xl lg:text-5xl md:text-3xl sm:text-2xl text-lg font-medium text-white tracking-widest">
                            with <span class="4xl:text-11xl 3xl:text-10xl 2xl:text-9.5xl xl:text-9xl lg:text-8xl md:text-7xl sm:text-6xl text-4xl font-bold uppercase text-green-d5ff40">fusionbody</span> gym
                        </p>       
                    </div>
                    <div class="grid md:grid-cols-2 grid-cols-1 px-10 xl:py-4 lg:py-2 py-1">
                        <div class="flex justify-center">
                            <img src={{ asset ('img/1.png') }} alt="pict1" class="w-auto xl:h-300 md:h-200 h-auto object-fill rounded-xl">
                        </div>
                        <div class="xl:px-16 md:px-12 px-6">
                            <div class="grid grid-rows-2 mx-auto max-w-xl text-left">
                                <div>
                                    <p class="font-opensans 2xl:text-3xl md:text-lg md:text-start text-center text-lg font-light capitalize text-white break-words md:mt-0 mt-4">
                                        A training center that blends cutting-edge technology, top-notch facilities, 
                                        and experienced trainers to help you reach your maximum potential
                                    </p>         
                                </div>                                           
                                <div class="2xl:mt-20 xl:mt-24 lg:mt-10 mt-5">
                                    <div class="md:flex-none md:justify-start flex justify-center">
                                        <a href="#" class="font-barlow inline-flex items-center rounded-full md:w-full w-auto h-auto 2xl:px-6 2xl:py-3 md:px-3 md:py-2 px-3 py-1.5 font-bold 2xl:text-4xl md:text-xl text-lg tracking-wide text-black-252525 bg-green-d5ff40 transform duration-200 hover:opacity-50">
                                            <span class="pr-10 2xl:pr-64 xl:pr-40 md:pr-20 lg:pr-24"> Get Started </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="arrow-circle-down" viewBox="0 0 24 24" class="2xl:w-10 2xl:h-10 w-7 h-7 -rotate-45">
                                                <path d="M0,12A12,12,0,1,0,12,0,12.013,12.013,0,0,0,0,12Zm22,0A10,10,0,1,1,12,2,10.011,10.011,0,0,1,22,12ZM13.121,6.293a1,1,0,0,0,0,1.414L16.413,11,6,11.007a1,1,0,1,0,0,2L16.414,13l-3.293,3.293a1,1,0,1,0,1.389,1.438l.025-.024,3.586-3.585a3,3,0,0,0,0-4.243h0L14.535,6.293A1,1,0,0,0,13.121,6.293Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- About --}}
        <section id="about" class="overflow-hidden h-auto">
            <div class="flex my-16">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img alt="" src={{ asset ('img/nike.png') }} class="relative block h-auto w-auto object-cover"/>
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src={{ asset ('img/puma.png') }} class="relative block h-auto w-auto object-cover"/>
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src={{ asset ('img/under.png') }} class="relative block h-auto w-auto object-cover"/>
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src={{ asset ('img/nb.png') }} class="relative block h-auto w-auto object-cover"/>
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src={{ asset ('img/adidas.png') }} class="relative block h-auto w-auto object-cover"/>
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src={{ asset ('img/reebok.png') }} class="relative block h-auto w-auto object-cover"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto py-10 items-center px-1">
                <h2 class="md:text-6xl text-4xl font-bold text-center font-barlow uppercase tracking-wide text-black-252525">
                    why choose us
                </h2>
                <p class="md:text-2xl text-lg font-semibold text-black-494949 text-center normal-case font-barlow py-4">
                    <span class="uppercase">FUSIONBODY</span> gym is where cutting-edge technology and unparalleled training experience collide to help you reach your fitness goals.
                </p>
                <div class="flex flex-wrap">
                    <div class="font-opensans md:w-1/2 w-full rounded-xl">
                        <div class="p-4">
                            <img alt="" src={{ asset ('img/1.png') }} class="relative block h-auto w-full object-cover"/>
                            <div class="relative flex items-center justify-center p-4 xl:-mt-24 -mt-20">
                                <a href="#" class="rounded-full w-full xl:px-5 xl:py-5 py-3 px-3 font-bold xl:text-2xl md:text-lg text-xl text-center tracking-wide text-black-252525 bg-white transform duration-200 hover:bg-green-d5ff40">
                                    CUTTING-EDGE TECHNOLOGY
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="font-opensans md:w-1/2 w-full rounded-xl">
                        <div class="p-4">
                            <img alt="" src={{ asset ('img/1.png') }} class="relative block h-auto w-full object-cover"/>
                            <div class="relative flex items-center justify-center p-4 xl:-mt-24 -mt-20">
                                <a href="#" class="rounded-full w-full xl:px-5 xl:py-5 py-3 px-3 font-bold xl:text-2xl md:text-lg text-xl text-center tracking-wide text-black-252525 bg-white transform duration-200 hover:bg-green-d5ff40">
                                    EXPERIENCED TRAINERS
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="font-opensans md:w-1/2 w-full rounded-xl">
                        <div class="p-4">
                            <img alt="" src={{ asset ('img/1.png') }} class="relative block h-auto w-full object-cover"/>
                            <div class="relative flex items-center justify-center p-4 xl:-mt-24 -mt-20">
                                <a href="#" class="rounded-full w-full xl:px-5 xl:py-5 py-3 px-3 font-bold xl:text-2xl md:text-lg text-xl text-center tracking-wide text-black-252525 bg-white transform duration-200 hover:bg-green-d5ff40">
                                    CUSTOMIZABLE WORKOUTS
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="font-opensans md:w-1/2 w-full rounded-xl">
                        <div class="p-4">
                            <img alt="" src={{ asset ('img/1.png') }} class="relative block h-auto w-full object-cover"/>
                            <div class="relative flex items-center justify-center p-4 xl:-mt-24 -mt-20">
                                <a href="#" class="rounded-full w-full xl:px-5 xl:py-5 py-3 px-3 font-bold xl:text-2xl md:text-lg text-xl text-center tracking-wide text-black-252525 bg-white transform duration-200 hover:bg-green-d5ff40">
                                    MOTIVATING COMMUNITY
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Package --}}
        <section id="package" class="overflow-hidden h-auto">
            <div class="container mx-auto py-10 flex justify-center">
                <div class="w-full h-auto bg-black-252525 rounded-[56px] py-10">
                    <h1 class="xl:text-8xl lg:text-6xl md:text-5xl text-4xl font-bold uppercase text-white text-center font-barlow">GYM PACKAGE PRICE</h1>
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-8 items-start pt-5">   
                        <div class="justify-center px-10">
                            {{-- Basic Plan --}}
                            <div class="2xl:pb-7 pb-4">
                                <h1 class="xl:text-3xl text-xl font-plusjakartasans font-normal uppercase text-white">BASIC PLAN</h1>
                                <p class="xl:text-lg text-base font-plusjakartasans font-normal text-white pt-1">
                                    <span class="uppercase xl:text-4xl text-2xl text-green-d5ff40">$49</span> /month
                                </p>
                                <ul class="font-opensans text-white p-1">
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base"> Get access to gym facilities</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base"> Unlimited group fitness classes</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base"> Access to online workout resources</p>
                                    </li>
                                </ul>
                                <a href="#" class="inline-flex font-plusjakartasans items-center justify-center rounded-full px-5 py-2 font-medium text-lg tracking-wide text-black-252525 bg-green-d5ff40 transform duration-200 hover:opacity-50">
                                    Getting Started
                                </a>
                                <hr class="2xl:mt-10 mt-5 border border-white-fafafa bg-white-fafafa">
                            </div>
                            {{-- Premium Plan --}}
                            <div class="2xl:pb-7 pb-4">
                                <h1 class="xl:text-3xl text-xl font-plusjakartasans font-normal uppercase text-white">PREMIUM PLAN</h1>
                                <p class="xl:text-lg text-base font-plusjakartasans font-normal text-white pt-1">
                                    <span class="uppercase xl:text-4xl text-2xl text-green-d5ff40">$99</span> /month
                                </p>
                                <ul class="font-opensans text-white p-1">
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Basic Package</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Personal training sessions</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Nutritional counseling</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Access to the sauna and steam room</p>
                                    </li>
                                </ul>
                                <a href="#" class="inline-flex font-plusjakartasans items-center justify-center rounded-full px-5 py-2 font-medium text-lg tracking-wide text-black-252525 bg-green-d5ff40 transform duration-200 hover:opacity-50">
                                    Getting Started
                                </a>
                                <hr class="2xl:mt-10 mt-5 border border-white-fafafa bg-white-fafafa">
                            </div>
                            {{-- Ultimate Plan --}}
                            <div class="2xl:pb-7 pb-4">
                                <h1 class="xl:text-3xl text-xl font-plusjakartasans font-normal uppercase text-white">ULTIMATE PLAN</h1>
                                <p class="xl:text-lg text-base font-plusjakartasans font-normal text-white pt-1">
                                    <span class="uppercase xl:text-4xl text-2xl text-green-d5ff40">$149</span> /month
                                </p>
                                <ul class="font-opensans text-white p-1">
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Premium Package</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Exclusive access to the VIP lounge</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">Private bathroom</p>
                                    </li>
                                    <li class="2xl:pt-2 xl:pt-1 pt-auto flex items-center">
                                        <img alt="" src={{ asset ('img/checklist.png') }} class="w-3 h-3"> <p class="p-2 xl:text-lg text-base">24/7 access to the gym</p>
                                    </li>
                                </ul>
                                <a href="#" class="inline-flex font-plusjakartasans items-center justify-center rounded-full px-5 py-2 font-medium text-lg tracking-wide text-black-252525 bg-green-d5ff40 transform duration-200 hover:opacity-50">
                                    Getting Started
                                </a>
                            </div>
                        </div>   
                        <div class="px-10">
                            <div class="flex justify-center">
                                <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="p-2 w-36 h-20">
                                <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="p-2 w-36 h-20">
                                <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="p-2 w-36 h-20">
                                <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="p-2 w-36 h-20 xl:flex lg:hidden sm:flex hidden ">
                                <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="p-2 w-36 h-20 3xl:flex lg:hidden md:flex hidden">
                                <img src={{ asset ('img/Ornament60.png') }} alt="ornament2" class="p-2 w-36 h-20 4xl:flex hidden">
                            </div>   
                            <p class="text-lg font-plusjakartasans font-normal text-white pt-1">
                                Get started now and achieve your fitness goals with FUSIONBODY! Join now and get a special discount of <span class="text-green-d5ff40"> 10% </span> on the first month of your membership."
                            </p>
                            <div class="font-opensans rounded-xl py-5">
                                <div class="flex justify-center">
                                    <img alt="" src={{ asset ('img/3.png') }} class="h-auto 4xl:w-3/4 w-full object-cover rounded-xl"/>
                                </div>
                                <div class="relative flex items-center justify-center p-4 -mt-24">
                                    <a href="#" class="inline-flex items-center justify-center rounded-full border-black-252525 border-2 w-auto 3xl:px-24 2xl:px-16 xl:px-12 lg:px-8 md:px-32 sm:px-24 px-12 py-2 font-bold xl:text-2xl lg:text-lg md:text-2xl text-lg text-center tracking-wide text-black-252525  hover:bg-white transform duration-200 bg-green-d5ff40 uppercase">
                                        <span class="pr-10"> transform your body </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" id="arrow-circle-down" viewBox="0 0 24 24" class="xl:w-10 xl:h-10 w-7 h-7 -rotate-45">
                                            <path d="M0,12A12,12,0,1,0,12,0,12.013,12.013,0,0,0,0,12Zm22,0A10,10,0,1,1,12,2,10.011,10.011,0,0,1,22,12ZM13.121,6.293a1,1,0,0,0,0,1.414L16.413,11,6,11.007a1,1,0,1,0,0,2L16.414,13l-3.293,3.293a1,1,0,1,0,1.389,1.438l.025-.024,3.586-3.585a3,3,0,0,0,0-4.243h0L14.535,6.293A1,1,0,0,0,13.121,6.293Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </section>

        {{-- Testimoni --}}
        <section id="testimoni" class="overflow-hidden h-auto">
            <div class="container mx-auto py-10">
                <h2 class="md:text-6xl text-4xl font-bold text-center font-barlow uppercase tracking-wide text-black-252525 pb-10">
                    what they say
                </h2>
                <div class="py-5 w-full h-auto bg-black-252525 rounded-[56px]">
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-8 items-center">   
                        <div class="flex justify-center">
                            <img src={{ asset ('img/4.png') }} alt="" class="p-2 lg:h-2/3 lg:w-2/3 h-2/4 w-2/4 object-cover rounded-xl">                                   
                        </div>
                        <div class="lg:pr-24 items-center lg:py-0 lg:px-0 py-1 px-5">                       
                            <div class="swiper-container !overflow-hidden">
                                <div class="swiper-wrapper">
                                    {{-- <div class="swiper-slide">
                                        <div class="flex flex-col items-center justify-center">
                                            <img src={{ asset ('img/profile.jpg') }} alt="profile" class="h-32 w-32 object-cover rounded-full">
                                            <h2 class="font-opensans font-semibold text-2xl p-5 text-green-d5ff40">Michele</h2>
                                            <p class="text-white lg:text-start text-center font-opensans font-base text-xl p-5">
                                                FUSIONBODY gym has exceeded all of my expectations.
                                            </p>
                                        </div>
                                    </div> --}}
                                    @foreach ($testimonys as $testimony)
                                        <div class="swiper-slide">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src={{ $testimony->image_url }} alt="profile" class="h-32 w-32 object-cover rounded-full">
                                                <h2 class="font-opensans font-semibold text-2xl p-5 text-green-d5ff40">{{ $testimony->name }}</h2>
                                                <p class="text-white lg:text-start text-center font-opensans font-base text-xl p-5">
                                                    {{ $testimony->testimony_id }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>                            
                            <div class="flex justify-center items-center">
                                <button class="prev-button rounded-full p-3 text-green-d5ff40 transition duration-200 hover:rounded-full hover:bg-green-d5ff40 hover:text-black-252525">
                                    <span class="sr-only">Previous Slide</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                                <div class="swiper-pagination !relative"></div>  
                                <button class="next-button rounded-full p-3 text-green-d5ff40 transition duration-200 hover:rounded-full hover:bg-green-d5ff40 hover:text-black-252525">
                                    <span class="sr-only">Next Slide</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer id="contact" class="overflow-hidden h-auto bg-black-252525 rounded-t-[48px] mt-10">
            <div class="container mx-auto px-5 mt-10">
                <p class="md:text-xl text-lg font-bold font-barlow uppercase tracking-wide text-white font-opensans px-6">
                    Join the Fitness Revolution with
                </p>
                <div class="flex items-center px-5">
                    <h2 class="xl:text-9xl md:text-7xl text-5xl font-extrabold font-barlow uppercase tracking-wide text-green-d5ff40 font-opensans">
                        FUSIONBODY
                    </h2>                    
                    <img src={{ asset ('img/arrowe.png') }} class="xl:w-28 md:w-24 w-20">
                </div>
                <div class="bg-black-252525 font-opensans font-normal">
                    <div class="grid xl:grid-cols-2 grid-cols-1 xl:gap-8 gap-4 items-start pt-5">   
                        <div class="font-opensans w-full p-2 rounded-xl">
                            <ul class="flex gap-3 text-white">
                                <li>
                                    <a href="#about" class="p-4 py-2 uppercase block no-underline transition-colors duration-300 transform hover:text-gray-200 hover:text-underline">
                                        about us
                                    </a>
                                </li>
                                <li>
                                    <a href="#service" class="p-4 py-2 uppercase block no-underline transition-colors duration-300 transform hover:text-gray-200 hover:text-underline">
                                        services
                                    </a>
                                </li>
                                <li>
                                    <a href="#service" class="p-4 py-2 uppercase block no-underline transition-colors duration-300 transform hover:text-gray-200 hover:text-underline">
                                        our teams
                                    </a>
                                </li>
                                <li>
                                    <a href="#service" class="p-4 py-2 uppercase block no-underline transition-colors duration-300 transform hover:text-gray-200 hover:text-underline">
                                        contact
                                    </a>
                                </li>
                            </ul>
                        </div>                        
                        <div class="font-opensans w-full p-2 rounded-xl">
                            <ul class="flex xl:justify-end justify-start gap-3 text-white">
                                <li>
                                    <a href="#pp" class="p-4 py-2 block no-underline transition-colors duration-300 transform hover:text-gray-200 hover:text-underline">
                                        Privacy Policy
                                    </a>
                                </li>
                                <li class="p-4 py-2 block">
                                    |
                                </li>
                                <li>
                                    <a href="#tnc" class="p-4 py-2 block no-underline transition-colors duration-300 transform hover:text-gray-200 hover:text-underline">
                                        Term & Conditions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>

    {{-- Brand Swiper Javasript --}}
    <script>
        new Swiper('.swiper', {
            loop: true,
            spaceBetween: 24,
            slidesPerView: 1,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2.35,
                    centeredSlides: true,
                },
                1024: {
                    slidesPerView: 4.35,
                    centeredSlides: false,
                }
            },
        })
    </script>
    {{-- Recommended Slider Javasript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            spaceBetween: 32,
            slidesPerView: 1,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
            nextEl: '.next-button',
            prevEl: '.prev-button',
            },
            breakpoints: {
            640: {
                slidesPerView: 1,
                centeredSlides: true,
            },
            1024: {
                slidesPerView: 1,
                centeredSlides: false,
            },
            },
        })
        })
    </script>
    {{-- Toggle Menu --}}
    <script type="text/javascript">
        const button = document.querySelector('#menu-button');
        const menu = document.querySelector('#menu');
        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('bg-green-d5ff40');
        });
    </script>

</html>
