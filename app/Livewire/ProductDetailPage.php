<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function incrementQty()
    {
        $this->quantity++;
    }

    public function decrementQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemsToCartWithQty($product_id, $this->quantity);

        // Update cart count in Navbar
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // LivewireAlert v3 syntax using facade
        LivewireAlert::alert([
            'type' => 'success',
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Product added to cart successfully!',
        ]);
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    #[Title('Product Detail Page')]
    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
