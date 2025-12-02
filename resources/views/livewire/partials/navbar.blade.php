@php
    function active($route) {
        return request()->is($route) ? 'text-blue-600 dark:text-blue-500' : 'text-gray-500 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500';
    }
@endphp

<header class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 dark:bg-gray-800 shadow-md">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
    <div class="relative md:flex md:items-center md:justify-between">

      <div class="flex items-center justify-between">
        <a href="/" class="flex-none text-xl font-semibold dark:text-white">hahay</a>

        <div class="md:hidden">
          <button type="button"
            class="hs-collapse-toggle flex justify-center items-center w-9 h-9 rounded-lg border border-gray-200 dark:border-gray-700"
            data-hs-collapse="#navbar-collapse-with-animation">
            <svg class="hs-collapse-open:hidden w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>
      </div>

      <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="max-h-[75vh] overflow-y-auto">

          <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:divide-y-0">

            <a href="/" class="font-medium py-3 md:py-6 {{ active('/') }}">
              Home
            </a>

            <a href="/categories" class="font-medium py-3 md:py-6 {{ active('categories') }}">
              Categories
            </a>

            <a href="/products" class="font-medium py-3 md:py-6 {{ active('products') }}">
              Products
            </a>

            <a href="/cart" class="font-medium flex items-center py-3 md:py-6 {{ active('cart') }}">
              <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                <circle cx="9" cy="10.5" r=".375" />
                <circle cx="16.5" cy="10.5" r=".375" />
              </svg>
              <span class="mr-1">Cart</span>
              <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">4</span>
            </a>

            <div class="pt-3 md:pt-0">
              <a href="/login"
                 class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                 Log in
              </a>
            </div>

          </div>

        </div>
      </div>

    </div>
  </nav>
</header>
