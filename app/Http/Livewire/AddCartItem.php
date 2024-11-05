<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $product, $quantity;
    public $qty = 1;
    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

    public function mount(){ //Constructor method will execute once products have been loaded
        $this->quantity = qty_available($this->product->id);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }
    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        Cart::add(['id' => $this->product->id,
                    'name' => $this->product->name,
                    'qty' => $this->qty,
                    'price' => $this->product->price,
                    'weight' => 550,
                    'options' => $this->options
                ]);

        $this->quantity = qty_available($this->product->id); //The info is updated
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render'); //For a component the event will be emitTo. Sends to Dropdown component
    }

    public function render(){
        return view('livewire.add-cart-item');
    }
}
