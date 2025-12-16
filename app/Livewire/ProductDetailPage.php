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

    public function mount($slug)
    {
        $this->slug = $slug;
    }

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
        // Add product with quantity
        $total_count = CartManagement::addItemsToCart($product_id, $this->quantity);

        // Update navbar count
        $this->dispatch('update-cart-count', total_count: $total_count)
            ->to(Navbar::class);

        // Alert
        LivewireAlert::title('Success')
            ->text('Product added to cart successfully!')
            ->success()
            ->toast()
            ->position('top-end')
            ->timer(3000)
            ->show();
    }

    #[Title('Product Detail Page')]
    public function render()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail();

        return view('livewire.product-detail-page', [
            'product' => $product,
            // ADD PRICE FIX HERE
            'price' => $product->selling_price ?? 0,
        ]);
    }
}
