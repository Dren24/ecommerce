<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">

        <section class="py-10 bg-gray-50 dark:bg-gray-800 rounded-lg">
            <div class="px-4 mx-auto max-w-7xl lg:py-6 md:px-6">

                <div class="flex flex-wrap -mx-3 mb-24">

                    {{-- LEFT SIDEBAR --}}
                    <div class="w-full pr-2 lg:w-1/4">

                        {{-- CATEGORIES --}}
                        <div class="p-4 mb-5 bg-white dark:bg-gray-900 border dark:border-gray-800">
                            <h2 class="text-2xl font-bold dark:text-gray-300">Categories</h2>
                            <div class="w-16 border-b border-blue-500 my-3"></div>

                            @foreach ($categories as $category)
                                <label class="flex items-center mb-3 text-gray-600 dark:text-gray-300">
                                    <input type="checkbox"
                                           wire:model.live="selectedCategories"
                                           value="{{ $category->id }}"
                                           class="mr-2">
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>

                        {{-- BRANDS --}}
                        <div class="p-4 mb-5 bg-white dark:bg-gray-900 border dark:border-gray-800">
                            <h2 class="text-2xl font-bold dark:text-gray-300">Brands</h2>
                            <div class="w-16 border-b border-blue-500 my-3"></div>

                            @foreach ($brands as $brand)
                                <label class="flex items-center mb-3 dark:text-gray-300">
                                    <input type="checkbox"
                                           wire:model.live="selectedBrands"
                                           value="{{ $brand->id }}"
                                           class="mr-2">
                                    {{ $brand->name }}
                                </label>
                            @endforeach
                        </div>

                        {{-- PRICE --}}
                        <div class="p-4 bg-white dark:bg-gray-900 border dark:border-gray-800">
                            <h2 class="text-2xl font-bold dark:text-gray-300">Price</h2>
                            <div class="w-16 border-b border-blue-500 my-3"></div>

                            <div class="font-semibold text-blue-600">
                                {{ Number::currency($priceRange ?? 0, 'PHP') }}
                            </div>

                            <input type="range" 
                                   wire:model.live="priceRange"
                                   max="50000" step="500"
                                   class="w-full mt-3">
                        </div>

                    </div>

                    {{-- RIGHT PRODUCT GRID --}}
                    <div class="w-full px-3 lg:w-3/4">

                        {{-- SORT DROPDOWN --}}
                        <div class="flex justify-end mb-6">
                            <select wire:model.live="sort"
                                    class="p-2 bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
                                <option value="">Sort</option>
                                <option value="latest">Latest</option>
                                <option value="price">Price</option>
                            </select>
                        </div>

                        {{-- PRODUCTS GRID --}}
                        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

                            @forelse ($products as $product)

                                @php
                                    $img = is_array($product->image)
                                        ? ($product->image[0] ?? null)
                                        : $product->image;

                                    $img = str_replace('products/', '', $img);

                                    $imagePath = $img
                                        ? asset('storage/products/' . $img)
                                        : asset('noimage.png');
                                @endphp

                                <div class="border border-gray-300 dark:border-gray-700 rounded-md overflow-hidden">

                                    <a href="/products/{{ $product->slug }}">
                                        <img src="{{ $imagePath }}"
                                             class="w-full h-56 object-cover"
                                             onerror="this.src='/noimage.png'">
                                    </a>

                                    <div class="p-3">
                                        <h3 class="text-lg font-medium dark:text-gray-300">
                                            {{ $product->name }}
                                        </h3>

                                        {{-- PRICE FIX --}}
                                        <p class="text-green-600 dark:text-green-400 text-lg mt-1">
                                            {{ Number::currency($product->selling_price ?? 0, 'PHP') }}
                                        </p>
                                    </div>

                                    <div class="flex justify-center p-4 border-t">
                                        <button wire:click.prevent="addToCart({{ $product->id }})"
                                            class="text-gray-600 dark:text-gray-300 hover:text-red-500">
                                            Add to Cart
                                        </button>
                                    </div>

                                </div>

                            @empty
                                <p class="text-gray-500 dark:text-gray-300">No products found.</p>
                            @endforelse

                        </div>

                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>
</div>
