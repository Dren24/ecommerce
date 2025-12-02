<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert; // Facade
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

    // Add products to cart
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemsToCart($product_id);

        // Update cart count in Navbar
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // LivewireAlert v4 (Facade)
        LivewireAlert::title('Success')
            ->text('Product added to cart successfully!')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->timer(3000)
            ->show();
    }

    public function render()
    {
        $products = Product::query()->where('is_active', true);

        if (!empty($this->selectedCategories)) {
            $products->whereIn('category_id', $this->selectedCategories);
        }

        if (!empty($this->selectedBrands)) {
            $products->whereIn('brand_id', $this->selectedBrands);
        }

        if ($this->featured) {
            $products->where('is_featured', true);
        }

        if ($this->onSale) {
            $products->where('on_sale', true);
        }

        if ($this->priceRange) {
            $products->whereBetween('price', [0, $this->priceRange]);
        }

        if ($this->sort == 'price') {
            $products->orderBy('price');
        }

        if ($this->sort == 'latest') {
            $products->latest();
        }

        return view('livewire.products-page', [
            'products' => $products->paginate(4),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::query()->where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
