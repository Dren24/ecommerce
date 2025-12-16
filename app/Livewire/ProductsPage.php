<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

class ProductsPage extends Component
{
    use WithPagination;

    #[Title('Products Page')]
    #[Url()]
    public $selectedCategories = [];

    #[Url()]
    public $selectedBrands = [];

    #[Url()]
    public $featured;

    #[Url()]
    public $onSale;

    #[Url()]
    public $priceRange = 0;

    #[Url()]
    public $sort = 'latest';

    // Add to Cart
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemsToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)
            ->to(Navbar::class);

        LivewireAlert::title('Success')
            ->text('Product added to cart successfully!')
            ->success()
            ->toast()
            ->timer(3000)
            ->position('bottom-end')
            ->show();
    }

    public function render()
    {
        $products = Product::query()->where('is_active', true);

        // Filter by Categories
        if (!empty($this->selectedCategories)) {
            $products->whereIn('category_id', $this->selectedCategories);
        }

        // Filter by Brands
        if (!empty($this->selectedBrands)) {
            $products->whereIn('brand_id', $this->selectedBrands);
        }

        // Featured
        if ($this->featured) {
            $products->where('is_featured', true);
        }

        // On Sale
        if ($this->onSale) {
            $products->where('on_sale', true);
        }

        // PRICE FILTER FIX — USE selling_price
        if ($this->priceRange > 0) {
            $products->whereBetween('selling_price', [0, $this->priceRange]);
        }

        // SORT FIX — USE selling_price
        if ($this->sort == 'price') {
            $products->orderBy('selling_price', 'asc');
        }

        if ($this->sort == 'latest') {
            $products->latest();
        }

        return view('livewire.products-page', [
            'products' => $products->paginate(4),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
