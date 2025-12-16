<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">

        <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
            <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
                <div class="flex flex-wrap -mx-4">

                    {{-- ========================================= --}}
                    {{--                IMAGE SECTION               --}}
                    {{-- ========================================= --}}
                    @php
                        // MAIN IMAGE (single string)
                        $mainImage = $product->image;

                        // Clean duplicate folder
                        $mainImage = str_replace('products/', '', $mainImage);

                        $mainImageUrl = $mainImage
                            ? asset('storage/products/' . $mainImage)
                            : asset('noimage.png');
                    @endphp

                    <div class="w-full mb-8 md:w-1/2 md:mb-0"
                        x-data="{ mainImage: '{{ $mainImageUrl }}' }">

                        <div class="sticky top-0 overflow-hidden">

                            {{-- MAIN IMAGE --}}
                            <div class="relative mb-6 lg:mb-10 lg:h-2/4">
                                <img x-bind:src="mainImage"
                                     class="object-cover w-full lg:h-full"
                                     onerror="this.src='/noimage.png'">
                            </div>

                            {{-- **THUMBNAIL — ONLY ONE IMAGE (NO LOOP)** --}}
                            <div class="flex-wrap hidden md:flex">

                                @php
                                    $thumbUrl = $mainImageUrl;
                                @endphp

                                <div class="w-1/2 p-2 sm:w-1/4"
                                     x-on:click="mainImage='{{ $thumbUrl }}'">

                                    <img src="{{ $thumbUrl }}"
                                         class="object-cover w-full lg:h-20 cursor-pointer hover:border hover:border-blue-500"
                                         onerror="this.src='/noimage.png'">
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- ========================================= --}}
                    {{--            PRODUCT INFORMATION             --}}
                    {{-- ========================================= --}}
                    <div class="w-full px-4 md:w-1/2">
                        <div class="lg:pl-20">

                            {{-- PRODUCT NAME --}}
                            <h2 class="text-3xl md:text-4xl font-bold dark:text-gray-300 mb-4">
                                {{ $product->name }}
                            </h2>

                            {{-- PRICE --}}
                            <p class="mb-6 text-4xl font-bold text-gray-700 dark:text-gray-300">
                                {{ Number::currency($product->price ?? 0, 'PHP') }}
                            </p>

                            {{-- DESCRIPTION --}}
                            <p class="text-gray-700 dark:text-gray-400 leading-relaxed">
                                {!! Str::markdown($product->description) !!}
                            </p>

                            {{-- QUANTITY --}}
                            <div class="w-32 mt-8">
                                <label class="text-lg font-semibold text-gray-700 dark:text-gray-400">
                                    Quantity
                                </label>

                                <div class="relative flex w-full h-10 mt-3">
                                    <button wire:click="decrementQty"
                                        class="w-10 bg-gray-300 dark:bg-gray-900 rounded-l hover:bg-gray-400">
                                        -
                                    </button>

                                    <input type="number" readonly wire:model="quantity"
                                        class="flex-1 bg-gray-300 dark:bg-gray-900 text-center">

                                    <button wire:click="incrementQty"
                                        class="w-10 bg-gray-300 dark:bg-gray-900 rounded-r hover:bg-gray-400">
                                        +
                                    </button>
                                </div>
                            </div>

                            {{-- ADD TO CART --}}
                            <div class="mt-8">
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="w-full lg:w-2/5 p-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to Cart</span>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})">Loading…</span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
</div>
