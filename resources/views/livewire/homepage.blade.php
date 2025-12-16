<div>

{{-- Hero section start --}}
<div class="w-full h-screen bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid md:grid-cols-2 gap-6 md:gap-12 xl:gap-20 md:items-center">

            {{-- LEFT CONTENT --}}
            <div>
                <h1 class="block text-4xl font-bold text-white sm:text-5xl lg:text-6xl leading-tight">
                    Upgrade Your Ride with 
                    <span class="text-blue-500">RevnoParts</span>
                </h1>

                <p class="mt-4 text-lg text-gray-300 max-w-lg">
                    High-quality motorcycle parts including brake systems, levers, sprockets, exhausts, 
                    handlebars, and more. Built for performance. Trusted by riders.
                </p>

                {{-- BUTTONS --}}
                <div class="mt-8 flex gap-3">
                    <a href="/products"
                        class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Shop Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>

                    <a href="/categories"
                        class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-white text-gray-800 hover:bg-gray-100">
                        Browse Categories
                    </a>
                </div>

                {{-- TRUST BADGES --}}
                <div class="mt-10 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-white text-xl font-bold">4.9 / 5</p>
                        <p class="text-gray-300 text-sm">Based on 15k rider reviews</p>
                        <p class="text-gray-400 text-sm mt-2">Google Reviews</p>
                    </div>
                    <div>
                        <p class="text-white text-xl font-bold">Top Rated</p>
                        <p class="text-gray-300 text-sm">Featured in MotoPerformance</p>
                        <p class="text-gray-400 text-sm mt-2">2024 Award</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT IMAGE --}}
            <div class="relative">
                <img class="w-full rounded-xl shadow-lg" 
                    src="https://i.ibb.co/Q3YW0kXH/Chat-GPT-Image-Dec-15-2025-07-47-33-PM.png"
                    alt="Motorcycle Parts Hero Image">

                <div class="absolute inset-0 bg-gradient-to-tr from-black/30 to-transparent rounded-xl"></div>
            </div>

        </div>
    </div>
</div>
{{-- Hero section end --}}


{{-- Brand Section Start --}}
<section class="py-20 bg-slate-100 dark:bg-slate-900">
    <div class="max-w-xl mx-auto text-center">
        <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-200">
            Popular <span class="text-blue-500">Brands</span>
        </h1>

        <div class="flex w-40 mt-4 mb-8 overflow-hidden rounded mx-auto">
            <div class="flex-1 h-2 bg-blue-300"></div>
            <div class="flex-1 h-2 bg-blue-500"></div>
            <div class="flex-1 h-2 bg-blue-700"></div>
        </div>

        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Trusted motorcycle aftermarket brands chosen by riders for quality, performance, 
            and durability.
        </p>
    </div>

    <div class="max-w-6xl px-4 mt-12 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach ($brands as $brand)

            @php
                $brandImg = str_replace(['brands/', 'products/'], '', $brand->image);
                $brandImg = asset('storage/brands/' . $brandImg);
            @endphp

            <div 
                wire:key="{{ $brand->id }}"
                class="group bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden"
            >
                <a href="/products?selectedBrands[0]={{ $brand->id }}">
                    <div class="overflow-hidden">
                        <img src="{{ $brandImg }}"
                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
                             alt="Brand Logo"
                             onerror="this.src='/noimage.png'">
                    </div>

                    <div class="p-5 text-center">
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-200 group-hover:text-blue-500 transition">
                            {{ $brand->name }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            View Products →
                        </p>
                    </div>
                </a>
            </div>

            @endforeach

        </div>
    </div>
</section>
{{-- Brand Section End --}}


{{-- Category Section Start --}}
<section class="py-20 bg-slate-100 dark:bg-slate-900">
    <div class="max-w-xl mx-auto text-center">
        <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-200">
            Browse <span class="text-blue-500">Categories</span>
        </h1>

        <div class="flex w-40 mt-4 mb-8 overflow-hidden rounded mx-auto">
            <div class="flex-1 h-2 bg-blue-300"></div>
            <div class="flex-1 h-2 bg-blue-500"></div>
            <div class="flex-1 h-2 bg-blue-700"></div>
        </div>

        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Find motorcycle parts from every essential category — exhausts, brakes, rims,
            sprockets, lighting, and more. Built for real riders.
        </p>
    </div>

    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mt-12 mx-auto">
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($category as $categories)

            @php
                $catImg = str_replace(['categories/', 'products/'], '', $categories->image);
                $catImg = asset('storage/categories/' . $catImg);
            @endphp

                <a wire:key="{{ $categories->id }}"
                    href="/products?selectedCategories[0]={{ $categories->id }}"
                    class="group bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 
                           rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-5 flex items-center gap-4">

                    <img src="{{ $catImg }}"
                         class="h-16 w-16 rounded-lg object-cover group-hover:scale-105 transition"
                         alt="Category Image"
                         onerror="this.src='/noimage.png'">

                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 group-hover:text-blue-500 transition">
                            {{ $categories->name }}
                        </h3>

                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                            View products →
                        </p>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</section>
{{-- Category Section End --}}


{{-- Customer Reviews Section --}}
<section class="py-20 bg-white dark:bg-gray-900">
    <div class="max-w-xl mx-auto text-center">
        <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-200">
            Customer <span class="text-blue-500">Reviews</span>
        </h1>

        <div class="flex w-40 mt-4 mb-8 overflow-hidden rounded mx-auto">
            <div class="flex-1 h-2 bg-blue-300"></div>
            <div class="flex-1 h-2 bg-blue-500"></div>
            <div class="flex-1 h-2 bg-blue-700"></div>
        </div>

        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Riders all over the Philippines trust RevnoParts for quality motorcycle parts and fast delivery.
        </p>
    </div>

    <div class="max-w-6xl mx-auto mt-14 px-4 grid md:grid-cols-2 gap-8">

        {{-- Review Cards --}}
        @include('partials.review-card', [
            'name' => 'Adren Roy',
            'role' => 'Rider / Web Designer',
            'image' => 'https://i.postimg.cc/rF6G0Dh9/pexels-emmy-e-2381069.jpg',
            'text' => 'RevnoParts never disappoints. The brake kit I ordered was high quality and arrived fast. Highly recommended!',
            'rating' => 5
        ])

        @include('partials.review-card', [
            'name' => 'Sonira Roy',
            'role' => 'Manager',
            'image' => 'https://i.postimg.cc/q7pv50zT/pexels-edmond-dant-s-4342352.jpg',
            'text' => 'Excellent customer service and authentic motorcycle parts. I’m definitely ordering again.',
            'rating' => 5
        ])

        @include('partials.review-card', [
            'name' => 'William Harry',
            'role' => 'Marketing Officer',
            'image' => 'https://i.postimg.cc/JzmrHQmk/pexels-pixabay-220453.jpg',
            'text' => 'The rims I ordered are solid! Good price and fast shipping. RevnoParts is my go-to shop now.',
            'rating' => 4
        ])

        @include('partials.review-card', [
            'name' => 'James Jack',
            'role' => 'Programmer',
            'image' => 'https://i.postimg.cc/4NMZPYdh/pexels-dinielle-de-veyra-4195342.jpg',
            'text' => 'High-quality mufflers at a good price. My bike sounds and performs way better. 10/10!',
            'rating' => 5
        ])

    </div>

</section>
{{-- Customer Reviews End --}}

</div>
